<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Event;
use App\Models\Region;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
//Request permet de récuperer les informations passées par le protocole http (get / post)

class EventController extends Controller
{
    /**
     * Affiche les événements validés
     */
    public function index(Request $request)
    {
        $departments = Department::all();
        $regions = Region::all();
        $types = Type::all();

        $topFavorites = $this->getTopFavorites();

        $events = Event::with('user')->where('is_validated', 1)
            ->when($request->input('keyword'), function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->when($request->input('departement'), function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
            ->when($request->input('region'), function ($query, $region_id) {
                return $query->where('region_id', $region_id);
            })
            ->when($request->input('type'), function ($query, $type_id) {
                return $query->where('type_id', $type_id);
            })
            ->when($request->input('beginning'), function ($query, $beginning_date) {
                return $query->where('beginningDate', '>=', $beginning_date);
            })
            ->when($request->input('end'), function ($query, $end_date) {
                return $query->where('endDate', '<=', $end_date);
            })
            ->orderBy('beginningDate', 'asc')->paginate(10);

        return view('events.index', compact('events', 'departments', 'regions', 'types', 'request', 'topFavorites'));
    }

    /**
     * Affiche les 3 événements avec le plus de favoris
     */
    private function getTopFavorites()
    {
        // Utiliser 'withCount' pour obtenir le nombre de favoris pour chaque événement
        $topFavorites = Event::where('is_validated', 1)
        ->withCount('favoritedBy')
        ->get()
        ->sortByDesc('favorited_by_count')
        ->take(3);

        return $topFavorites;
    }

    /**
     * Affiche les évènements de l'utilisateur
     */
    public function myEvents()
    {
        $user = auth()->user();
        $events = Event::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(8);
        return view('events.my_events', compact('events'));
    }

    /**
    * Affiche les événements que l'utilisateur à en favoris
    */
    public function myFavorites()
    {
        $user = auth()->user();        
        $favorites = $user->favoritedEvents()
                        ->where(function($query) use($user) {
                                $query->where('is_validated', 1)
                                    ->orWhere('events.user_id', $user->id);
                        })
                        ->paginate(10);         
        return view('events.favorite', compact('favorites'));
    }

    /**
    * Ajouter un événement en favoris
    */
    public function addFavorite($eventId)
    {
        $user = auth()->user();
        $user->favoritedEvents()->attach($eventId);
    
        return redirect()->back()->withSuccess('Évènement ajouté au favoris');
    }

    /**
    * Enlève un évènement en favoris
    */
    public function removeFavorite($eventId)
    {
        $user = auth()->user();
        $user->favoritedEvents()->detach($eventId);        
        return redirect()->back()->withSuccess('Évènement supprimé des favoris');
    }

    /**
    * Affiche les évènements en attente d'approbation 
    */
    public function pending()
    {
        $pendingEvents = Event::with('user')->where('is_validated', 0)->orderBy('updated_at', 'asc')->paginate(10);
        return view('events.pending', compact('pendingEvents'));
    }

    /**
    * Ajoute un message à un événement destiné à l'utilisateur
    */
    public function storeStaffMessage(Request $request, Event $event)
    {
        $request->validate([
            'staffMessage' => 'required|string|max:255|min:10',
        ]);
    
        $event->update([
            'staffMessage' => $request->staffMessage,
        ]);
    
        return redirect()->back()->withSuccess('Le message a été envoyé à l\'utilisateur.');
    }
    
    /**
    * Valide un événement
    */
    public function validateEvent(Request $request, Event $event)
    {
        $event->is_validated = 1;
        $event->staffMessage = null;
        $event->save();
        
        return redirect()->route('events.pending')->withSuccess('Événement validé avec succès.');
    }

    /**
    * Créer un événement dans la BDD
    */
    public function create()
    {
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();

        return view('events.create', compact('regions', 'departments', 'types'));
    }

    /**
    * Validation de la création
    */
    private function validationRules($isUpdate = false)
    {
        $rules = [
            'name' => 'required|string|max:75',
            'image_path' => ($isUpdate ? ['nullable'] : ['required']) + ['image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'beginningDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:beginningDate',
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|numeric|digits:10',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'description' => 'required|string|min:20|max:2000',
            'department_id' => 'required|integer|exists:departments,id',
            'region_id' => 'required|integer|exists:regions,id',
            'type_id' => 'required|integer|exists:types,id',
        ];
        return $rules;
    }
    
    /**
     * Sauvegarde un événement dans la BDD après validation
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate($this->validationRules());

        $imageName = $request->file('image_path')->store('events', 'public');        
        $event = Event::create([
            'name' => $request->name,
            'image_path' => $imageName,
            'beginningDate' => $request->beginningDate,
            'endDate' => $request->endDate,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'region_id' => $request->region_id,
            'type_id' => $request->type_id,
            'user_id' => $user->id
        ]);

        return redirect()->route('events.show', $event->id)->withSuccess('Évènement crée avec succès !');
    }

    /**
     * Affiche un événement au travers de son id
     */
    public function show(Event $event)
    {
        $this->authorize('view', $event);

        $topFavorites = $this->getTopFavorites();
        
        $comments = $event->comments()->with('user')->orderBy('created_at', 'desc')->paginate(5);

        return view('events.show', compact('event', 'comments', 'topFavorites'));
    }

    /**
    * Récupère un événement pour procéder à une mise à jour
    */
    public function edit(Event $event)
    {
        //Voir "Http/Policies"
        $this->authorize('update', $event);

        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();

        return view('events.edit', compact('event', 'regions', 'departments', 'types'));
    }

    /**
     * Met à jour un événement
     */
    public function update(Request $request, Event $event)
    {
         //Voir "Http/Policies"
        $this->authorize('update', $event);

        $request->validate($this->validationRules(true));

        $data = $request->all();
       

        // Regarde si il y un fichier dans la requete
        if ($request->hasFile('image_path')) {
            // On supprime alors l'ancienne image
            Storage::disk('public')->delete($event->image_path);
    
            // On sauvegarde la nouvelle image de la requete
            $imagePath = $request->file('image_path')->store('events', 'public');
    
            //Met a jour la chaine de caractère de l'image stockée.
            $data['image_path'] = $imagePath;
        }
        $event->is_validated = 0;      
        $event->update($data);
        
        return redirect()->route('events.show', $event->id)->withSuccess('Événement mis à jour avec succès !');
    }

    /**
     * Supprime un événement dans la BDD
     */
    public function destroy(Event $event)
    {
        //Voir "Http/Policies"
        $this->authorize('delete', $event);

        //Suppression de l'image de l'événement
        if($event->image_path) {
            $filePath = $event->image_path;
            if(Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            } 
        }

        $event->delete();

        //Supression depuis la page pending.blade.php
        if (request('fromEventPending') == 'pending') {
            return redirect()->route('events.pending')->withSuccess('Événement supprimé avec succès !');
        } else {
            return redirect()->route('events.myEvents')->withSuccess('Événement supprimé avec succès !');
        }
    }
}

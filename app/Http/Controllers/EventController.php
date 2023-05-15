<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Event;
use App\Models\Region;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//Request permet de récuperer les informations passées par le protocole http (get / post)


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $departments = Department::all();
    $regions = Region::all();
    $types = Type::all();

    $events = Event::with('user')->where('is_validated', 1)
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

        return view('events.index', compact('events', 'departments', 'regions', 'types', 'request'));
    }

    public function myEvents()
    {
        $user = auth()->user();
        $events = Event::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        return view('events.my_events', compact('events'));
    }

    public function myFavorites()
    {
        $user = auth()->user();        
        $favorites = $user->favoritedEvents;         
        return view('events.favorite', compact('favorites'));
    }

    public function addFavorite($eventId)
    {
        $user = auth()->user();
        $user->favoritedEvents()->attach($eventId);
    
        return redirect()->back()->withSuccess('Évènement ajouté au favoris');
    }

    public function removeFavorite($eventId)
    {
        $user = auth()->user();
        $user->favoritedEvents()->detach($eventId);        
        return redirect()->back()->withSuccess('Évènement supprimé des favoris');
    }


    public function pending()
    {
        $pendingEvents = Event::with('user')->where('is_validated', 0)->orderBy('updated_at', 'asc')->get();
        return view('events.pending', compact('pendingEvents'));
    }

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
    

    public function validateEvent(Request $request, Event $event)
    {
        $event->is_validated = 1;
        $event->save();        
        return redirect()->route('events.pending')->withSuccess('Événement validé avec succès.');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();

        return view('events.create', compact('regions', 'departments', 'types'));
    }

    private function validationRules($isUpdate = false)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image_path' => $isUpdate ? 'nullable' : 'required' . '|image|mimes:jpeg,png,jpg,svg|max:2048',
            'beginningDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:beginningDate',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|min:10|max:10',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'description' => 'required|string|min:20|max:5000',
            'department_id' => 'required|integer|exists:departments,id',
            'region_id' => 'required|integer|exists:regions,id',
            'type_id' => 'required|integer|exists:types,id',
        ];
        return $rules;
    }
    
    /**
     * Store a newly created resource in storage.
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
            'user_id' => $user->id // Set the user_id to the currently authenticated user
        ]);

        return redirect()->route('events.show', $event->id)->withSuccess('Évènement crée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $comments = $event->comments()->with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('events.show', compact('event', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();

        return view('events.edit', compact('event', 'regions', 'departments', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate($this->validationRules(true));

        $data = $request->all();

        // Check if a new image is uploaded
        if ($request->hasFile('image_path')) {
            // Delete the old image
            //Storage::delete($event->image_path);
            Storage::disk('public')->delete($event->image_path);
    
            // Store the new image
            $imagePath = $request->file('image_path')->store('events', 'public');
    
            // Update the image_path in the data array
            $data['image_path'] = $imagePath;
        }
    
        $event->update($data);

        return redirect()->route('events.show', $event->id)->withSuccess('Événement mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();

        //Supression depuis la page pending.blade.php
        if (request('fromEventPending') == 'pending') {
            return redirect()->route('events.pending')->withSuccess('Événement supprimé avec succès !');
        } else {
            return redirect()->route('events.myEvents')->withSuccess('Événement supprimé avec succès !');
        }
    }
}

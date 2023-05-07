<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Event;
use App\Models\Region;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
//Request permet de récuperer les informations passées par le protocole http (get / post)


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('user')->where('is_validated', 1)->paginate(10);;
        return view('events.index', compact('events'));
    }

    public function myEvents()
    {
        $user = auth()->user();
        $events = Event::with('user')->where('user_id', $user->id)->get();
        return view('events.my_events', compact('events'));
    }

        public function pending()
        {
            $pendingEvents = Event::with('user')->where('is_validated', 0)->get();
            return view('events.pending', compact('pendingEvents'));
        }

        public function validateEvent(Request $request, Event $event)
        {
            //Log::info('validateEvent called for event id: ' . $event->id);
            //$event->update(['is_validated' => 1]);
            $event->is_validated = 1;
            $event->save();
            //Log::info('Event validation status updated to: ' . $event->is_validated);
        
            return redirect()->route('events.pending')->with('success', 'Événement validé avec succès.');
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

        return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $comments = $event->comments()->with('user')->orderBy('created_at', 'desc')->get();
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

        return redirect()->route('events.show', $event->id)->with('success', 'Événement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();
        return redirect()->route('events.myEvents')->with('success', 'Événement supprimé avec succès.');
    }
}

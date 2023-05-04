<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
//Request permet de récuperer les informations passées par le protocole http (get / post)


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user === null) {
            // L'utilisateur n'est pas connecté, vous pouvez gérer cette situation ici, par exemple :

            return redirect()->back()->with('error', 'You must be logged in to create an event.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'required|string|max:255',
            //'image_path' => 'required|string|image|max:255',
            'beginningDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:beginningDate',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:10',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'description' => 'required|string|max:5000',
            'department_id' => 'required|integer|exists:departments,id',
            'region_id' => 'required|integer|exists:regions,id',
            'type_id' => 'required|integer|exists:types,id',
        ]);
        
        Event::create([
            'name' => $request->name,
            'image_path' => $request->image_path,
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

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}

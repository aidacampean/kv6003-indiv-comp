<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEvent;
use App\Http\Requests\StoreEvent;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Trip::whereHas('sections')->get();

        // return view('sections');
        // print_r($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $events = Event::all()->toArray();

        return view('sections',
            [
                'events' => 'create-trip',
                'data' => $events
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreEvent $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvent $request)
    {
        $validated = $request->validated();

        $event = Event::create([
            'trip_id' => $validated['id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'notes' => $validated['notes']
        ]);

        if ($event->save()) {
            return response()->json(['success' => true, 'id' => $event->id], 200);
        }

        return response('error', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
       // $event = Event::whereId($id)->firstOrFail();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvent $request, int $id)
    {
        //
        $validated = $request->validated();
        $event = Event::whereId($id)->firstOrFail();
        
        if ($event) {
            $event->name = $validated['name'];
            $event->description = $validated['description'];
            $event->notes = $validated['notes'];
        }

        if ($event->save()) {
            return response()->json(['success' => true], 200);
        }

        return response('error', 500);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {   
        $event = Event::whereId($id)->firstOrFail();
        if ($event) {
            // find event by id and delete if found
            $event->delete();
        }
        
        //feedback is needed so we can display a 'deleted' message on the itinerary
        
    }
}

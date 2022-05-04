<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEvent;
use App\Http\Requests\StoreEvent;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => Auth::id(),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvent $request, int $id)
    {
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
        // find event by id
        $event = Event::whereId($id)->firstOrFail();

        // delete if found and return success
        if ($event) {
            $event->delete();
            return response()->json(['success' => true], 200);
        }

        return response('error', 500);
    }
}

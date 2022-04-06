<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrip;
use App\Models\City;
use App\Models\Trip;
use App\Models\UserTrip;
use Illuminate\Support\Facades\Auth;
use Session;

class TripController extends Controller
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

    public function create()
    {
        $cities = City::all('id', 'name')->toArray();

        return view('planner.create_trip',
            [
                'section' => 'create-trip',
                'data' => $cities
            ]
        );
    }

    public function store(StoreTrip $request)
    {   
        $validated = $request->validated();
        $trip = Trip::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
            'city_id' => $validated['city_id'],
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'],
        ]);

        if ($trip->save()) {
            UserTrip::create([
                'trip_id' => $trip->id,
                'user_id' => Auth::id(),
                'role' => 'admin'
            ]);

            return response()->json(['success' => true, 'id' => $trip->id], 200);
        }

        return response('error', 500);
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
    //    $trip = Trip::whereId($id)->firstOrFail();

    }

    public function update(int $id)
    {
       //
    }


    public function destroy(int $id)
    {
        $trip = Trip::whereId($id)->firstOrFail();

        if ($this->authorize('delete', $trip)) {

            if ($trip) {
                // find trip by id and delete if found
                $trip->delete();
            }

            // if trip is deleted redirect the user to the same page and display a message
            if ($trip->trashed()) {
                return redirect()->back()->with('success', $trip->name . ' has been deleted.');
            }
            return redirect()->back()->with('error', 'We encountered an error removing the trip. Please try again.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrip;
use App\Models\City;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Session;

class TripController extends Controller
{
    // public function index()
    // {
    //     $trips = Trip::whereUserId(Auth::id())->get();
    //     return view('planTrip',
    //         [
    //             'section' => 'planTrip'
    //         ]
    //     );
    // }

    public function create()
    {
        $cities = City::all()->toArray();

        return view('create_trip',
            [
                'section' => 'create-trip',
                'data' => $cities
            ]
        );
    }

    public function store(StoreTrip $request)
    {   
        $validated = $request->validated();
        //dd($request->user('api'));
        $trip = Trip::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
            'city_id' => $validated['city_id'],
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'],
        ]);

        if ($trip->save()) {
            return response()->json(['success' => true, 'id' => $trip->id], 200);
            //return redirect('/trip/' . $id . '/itinerary/');
            //return response('success', Response::HTTP_CREATED);
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

        if ($trip) {
            // find trip by id and delete if found
            $trip->delete();
        }

        // if trip is deleted redirect the user to the same page and display a message
        if ($trip->trashed()) {
            return redirect('/home')->with('success', 'Your ' . $trip->name . ' has been deleted');
        }

    }
}

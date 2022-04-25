<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use Carbon;

class ItineraryController extends Controller
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
     * Display a listing of the resource.
     *
     * @param int $id - the trip ID
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $itinerary = Trip::whereId($id)
            ->whereHas(
                'collaborators',
                function ($q) {
                    $q->where('collaborators.user_id', '=', Auth::id());
                }
            )
            ->with('tasks')
            ->with('events:id,user_id,trip_id,name,description,notes,date')  //limit the selected columns
            ->firstOrFail()->toArray();

        //we need an array based on the days
        $to = Carbon\Carbon::createFromFormat('Y-m-d', $itinerary['date_to']);
        $from = Carbon\Carbon::createFromFormat('Y-m-d', $itinerary['date_from']);

        //use carbon to create a period between the trip start and end dates
        $period = Carbon\CarbonPeriod::create($from, $to);

        $days = [];

        // Iterate over the period to create the array
        foreach ($period as $date) {
            $days[$date->format('Y-m-d')] = [];
        }

        //if we have any events, they need to be added to the array created above
        if ($itinerary['events']) {
            //loop through each event and add to the array
            foreach ($itinerary['events'] as $event) {
                $days[$event['date']][] = $event;
            }
        }
        //add the days to the itinerary
        $itinerary['days'] = $days;

        return view(
            'planner.itinerary',
            [
                'section' => 'create-trip',
                'data' => $itinerary
            ]
        );
    }
}

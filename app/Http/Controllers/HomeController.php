<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $trips = Trip::with('usertrips')
            ->whereHas('usertrips', function($q) {
                $q->where('user_trips.user_id', '=', Auth::id());
            })
            ->orderBy('date_from', 'asc')
            ->get()->toArray();

        return view('planner.home',
            [
                'trips' => $trips,
                'section' => 'home',
                'user_id' => $userId
            ]
        );
    }
}

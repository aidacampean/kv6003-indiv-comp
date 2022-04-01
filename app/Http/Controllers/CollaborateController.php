<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserInvitation;
use App\Mail\InviteUser;
use App\Http\Requests\SendInvitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CollaborateController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $trips = Trip::whereId($id)
            ->whereUserId(Auth::id())
            ->with('collaborators')
            ->firstOrFail();
         //dd($trips);

            //->with('Users')

             // $collaborators = Collaborator::whereTripId($id)
        //     ->whereUserId(Auth::id())
        //     ->with('Trip')
        //     ->with('User')
        //     ->with('User')
        //     ->firstOrFail()->toArray();

           return view(
                'planner.collaborate',
            [
                'section' => 'create-trip',
                'trips' => $trips
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invite(int $id)
    {
        $trip = Trip::find($id)
            ->whereUserId(Auth::id())
            ->firstOrFail();
            
        return view(
                'planner.invite',
            [
                'section' => 'create-trip',
                'tripId' => $trip->id
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreInvite(SendInvitation $request, int $id)
    {
        // correction needed for the email address check so we need to ensure that an invite hasn't expired yet and is unique for this trip?
        $validated = $request->validated();

        if ($validated) {

            $invitation = UserInvitation::create([
                'trip_id' => $id,
                'email_address' => $validated['email'],
                'invite_code' => \Str::random(30),
                'expiry_date' => Carbon::now()->addDay()
            ]);

            $trip = Trip::whereId($id)->firstOrFail();
            $user = User::whereId(Auth::id())->firstOrFail();

            //check that the invitation was sent
            if ($invitation->save()) {
                // fix this
                try {
                    Mail::to($request->user())->send(new InviteUser($invitation, $trip, $user));
                    return redirect('/trip/' . $id . '/invite')
                            ->withSuccess('Invitation sent to ' . $validated['email']);

                } catch (\Exception $e) {
                    return redirect()->back()
                        ->withInput($request->input())
                        ->withError('There was an error sending the email');
                }
            }
        }
        
        return redirect()->back()
            ->withInput($request->input())
            ->withError('There was an error sending the email');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //check the resource exists
        $collaborator = Collaborator::whereId($id)
            ->firstOrFail();

        //delete the resource and redirect with a success message if deleted
        if ($collaborator->delete()) {
            return redirect('/trip/' . $collaborator->trip_id . '/collaborate')->with('success', $collaborator->username . ' has been removed');
        }

        return redirect()->back()->with('error', 'Error message');
    }
}
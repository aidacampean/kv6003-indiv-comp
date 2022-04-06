<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserInvitation;
use App\Models\UserTrip;
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
        $trip = Trip::whereId($id)
            ->whereUserId(Auth::id())
            ->with('tripCollaborators.user') // retrieve the user trip record with the user details
            ->with('userInvites') // retrieve the invites
            ->firstOrFail()->toArray();

           return view(
                'planner.collaborate',
            [
                'section' => 'create-trip',
                'trip' => $trip
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
                'email' => $validated['email'],
                'invite_code' => \Str::random(10)
            ]);

            $trip = Trip::whereId($id)->firstOrFail();
            $user = User::whereId(Auth::id())->firstOrFail();

            //check that the invitation was sent
            if ($invitation->save()) {
                // fix this
                try {
                    Mail::to($validated['email'])->send(new InviteUser($invitation, $trip, $user));
                    return redirect('/trip/' . $id . '/invite')
                            ->with('success', 'Invitation sent to ' . $validated['email']);

                } catch (\Exception $e) {
                    return redirect()->back()
                        ->withInput($request->input())
                        ->with('error', 'There was an error sending the email');
                }
            }
        }
        
        return redirect()->back()
            ->withInput($request->input())
            ->with('error', 'There was an error sending the email');
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
    public function destroyCollaborator(int $tripId, int $userTripId)
    {
        $trip = Trip::whereId($tripId)->firstOrFail();

        if ($this->authorize('delete', $trip)) {
            $userTripId = UserTrip::whereId($userTripId)
                    ->firstOrFail();
            //if the record exists and it has been deleted, redirect back
            if ($userTripId && $userTripId->delete()) {
                return redirect()->back()->with('success', 'User ' . $userTripId->username . ' has been deleted');
            }
            return redirect()->back()->with('error', 'We encountered an error removing the user. Please try again.');
        }

    }

    public function destroyInvite(int $tripId, int $inviteId)
    {
        $trip = Trip::whereId($tripId)->firstOrFail();

        if ($this->authorize('delete', $trip)) {

            $invite = UserInvitation::whereId($inviteId)->firstOrFail();

            //if the record exists and it has been deleted, redirect back
            if ($invite && $invite->delete()) {
                return redirect()->back()->with('success', 'Invite for ' . $invite->email . ' has been deleted');
            }

        // incomplete
        return redirect()->back()->with('error', 'We encountered an error removing the invite. Please try again.');
        }
    }
}
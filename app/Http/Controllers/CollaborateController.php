<?php

namespace App\Http\Controllers;

use App\Mail\InviteUser;
use App\Models\Task;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserInvitation;
use App\Http\Requests\StoreInvitation;
use App\Http\Requests\StoreTask;
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
            ->with('collaborators.user') // retrieve the user trip record with the user details from collaborators model
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
    public function displayInvite(int $id)
    {
        $trip = Trip::whereId($id)
            ->whereUserId(Auth::id())
            ->with('collaborators.user')
            ->firstOrFail()->toArray();

        return view(
            'planner.invite',
            [
                'section' => 'create-trip',
                'trip' => $trip
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInvite(StoreInvitation $request, int $id)
    {
        // correction needed for the email address check so we need
        //to ensure that an invite hasn't expired yet and is unique for this trip
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
                Mail::to($validated['email'])
                    ->send(new InviteUser($invitation, $trip, $user));
                return redirect('/trip/' . $id . '/invite')
                    ->with('success', 'Invitation sent to ' . $validated['email']);
            }

            return redirect()->back()
                ->withInput($request->input())
                ->with('error', 'There was an error with the request');
        }
    }
    public function storeTask(StoreTask $request, int $id, int $userId)
    {
        $validated = $request->validated();
        if ($validated) {
            //check if the trip exists
            $task = Task::whereTripId($id)
                ->whereCollaboratorId($userId)
                ->first();

            //check if the user has an existing record
            if ($task) {
                $task->task1 = $validated['task1'];
                $task->task2 = $validated['task2'];

                if ($task->save()) {
                    return response()->json(['success' => true], 200);
                }
            } else {        //no existing record so update
                $taskInsert = Task::create([
                    'trip_id' => $id,
                    'collaborator_id' => $userId,
                    'task1' => $validated['task1'],
                    'task2' => $validated['task2']
                ]);

                if ($taskInsert->save()) {
                    //return redirect()->back()->with('success', 'Task has been saved.');
                    return response()->json(['success' => true], 200);
                }
            }
        }

        return response()->json(['error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroyCollaborator(int $tripId, int $userTripId)
    // {
    //     $trip = Trip::whereId($tripId)->firstOrFail();

    //     if ($this->authorize('delete', $trip)) {
    //         $userTripId = Collaborator::whereId($userTripId)
    //                 ->firstOrFail();
    //         //if the record exists and it has been deleted, redirect back
    //         if ($userTripId && $userTripId->delete()) {
    //             return redirect()->back()->with('success', 'User ' . $userTripId->username . ' has been removed');
    //         }
    //         return redirect()->back()->with('error', 'We encountered an error removing the user. Please try again');
    //     }
    // }
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

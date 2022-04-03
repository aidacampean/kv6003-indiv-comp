<?php

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function view(User $user, Trip $trip)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Trip $trip)
    {
        //
    }
}

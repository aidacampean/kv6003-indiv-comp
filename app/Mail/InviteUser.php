<?php

namespace App\Mail;

use App\Models\UserInvitation;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\UserInvitation
     */
    public $userInvitation;
    public $trip;
    public $user;


    /**
     * Create a new message instance.
     *
     * @param \App\Models\UserInvitation
     * @return void
     */
    public function __construct(UserInvitation $userInvitation, Trip $trip, User $user)
    {
        $this->userInvitation = $userInvitation;
        $this->trip = $trip;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite', [
            'url' => route('register'),
            'user' => 'user',
            'trip' => 'trip',
            'invite_code' => $this->userInvitation->invite_code
        ]);
    }
}
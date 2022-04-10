<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\User;
use App\Models\UserInvitation;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Egulias\EmailValidator\Validation\RFCValidation;
// use Egulias\EmailValidator\Validation\DNSCheckValidation;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5','max:30'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:5' ,'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed'],
            'invite-code' => ['nullable', 'string', 'exists:user_invitations,invite_code,email,' . $data['email'] . '']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user->save()) {
            //if the user used an invite code during registration, we need to perform additional tasks
            if ($data['invite-code']) {
                $invite = UserInvitation::whereInviteCode($data['invite-code'])
                    ->whereEmail($data['email'])
                    ->first('trip_id');
        
                Collaborator::create([
                    'user_id' => $user->id,
                    'trip_id' => $invite['trip_id'],
                    'role' => 'collaborator'
                ]);
            }
        }

        return $user;
    }
}

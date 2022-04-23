<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // rewrite function from ResetsPassword to redirect to login page instead of homepage
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        event(new PasswordReset($user));
        return redirect('login')->with('success', 'Your password has been changed successfully');
    }

    // protected function sendResetResponse(Request $request, $response)
    // {
    //     if ($request->wantsJson()) {
    //         return new JsonResponse(['message' => trans($response)], 200);
    //     }

    //     return redirect($this->redirectPath())
    //                         ->with('success', 'Your password has been changed successfully');
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreEmail;
use App\Http\Requests\StorePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
        //$user = auth()->user()->email;
        $account = User::whereId(Auth::id())->firstOrFail();
        return view('my_account',
            [
                'section' => 'account',
                'account' => $account
                // 'username' => $account['username'],
            ]
        );

    }

    public function storeEmail(StoreEmail $request)
    {
        $validated = $request->validated();
        $account = User::whereId(Auth::id())->firstOrFail();

        if ($account) {
            $account->email = $validated['email'];
            // $account->username = $validated['username'];
        }

        if ($account->save()) {
            return redirect()->back();
        }

        return response('error', 500);

    }

    public function storePassword(StorePassword $request)
    {
        $validated = $request->validated();
        $account = User::whereId(Auth::id())->firstOrFail();

        if ($account) {
            $account->password = Hash::make($validated['new_password']);
        }

        if ($account->save()) {
            return redirect()->back();
        }

        return response('error', 500);

    }
}

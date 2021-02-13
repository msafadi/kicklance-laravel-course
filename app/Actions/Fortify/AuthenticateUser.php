<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    /**
     * 
     */
    public static function authenticate(Request $request)
    {
        $request->validate([
            config('fortify.username') => ['required'],
            'password' => ['required'],
        ]);

        // Check and validate user and login, return true in scuccess, or false otherwise 
        /*Auth::attempt([
            'username' => $request->post('username'),
            'password' => $request->post('password'),
        ], true);*/
        $username = $request->post('username');
        $password = $request->post('password');

        $user = User::where('username', $username)
            ->orWhere('email', $username)
            ->orWhere('phone', $username)
            ->first();
        
        if ($user && Hash::check($password, $user->password)) {
            return $user;

            // Login the user
            //Auth::login($user, $request->has('remember'));
        }
    }
}
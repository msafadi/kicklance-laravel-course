<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'device' => 'nullable',
        ]);

        $user = User::where('email', $request->post('email'))->first();
        if ($user && Hash::check($request->post('password'), $user->password)) {
            /*$token = Str::random(64);
            $user->api_token = $token;
            $user->save();*/

            $device = $request->post('device', $request->header('user-agent'));
            $token = $user->createToken($device);

            return [
                'code' => 1,
                'token' => $token->plainTextToken,
            ];
        }

        return response()->json([
            'code' => 0,
            'message' => 'Invalid username and password',
        ], 401);
    }


    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();

        return [
            'code' => 1,
            'message' => 'Token deleted',
        ];
    }
}

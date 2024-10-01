<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('authToken')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => auth()->user()
            ]);
        }
        
        return response()->json(['message' => 'Unauthorised'], 401);
    }


    public function profile()
    {
        // get current user
        $user = auth()->user();
        // return user data
        return response()->json([
            'user' => $user
        ]);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}

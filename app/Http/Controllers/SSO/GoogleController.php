<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();
        
        // register if not exist
        $existingUser = User::where('email', $user->email)->first();
        
        if (!$existingUser) {
            // create new user
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = encrypt(''); // Use bcrypt for password hashing
            $newUser->save();

            // login new user
            Auth::login($newUser);

        } else {
            // update existing user
            $existingUser->name = $user->name;
            $existingUser->email = $user->email;
            $existingUser->password = encrypt(''); // Use bcrypt for password hashing
            $existingUser->save();
            Auth::login($existingUser);
        }

        return redirect('/');
    }
}

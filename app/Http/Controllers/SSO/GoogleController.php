<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $google_user = Socialite::driver('google')->user();

        $user = User::where('email', $google_user->email)->first();

        if(!$user){
            $user = User::create([
                'name' => $google_user->name,
                'email' => $google_user->email,
                'password' => encrypt('')
            ]);  
        }

        Auth::login($user);

        return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Str; // Import the Str facade


class HRMSController extends Controller
{
    public function redirect()
    {
    
    $query = http_build_query([
        'client_id' => config('services.hrms.client_id'),
        'redirect_uri' => config('services.hrms.redirect'),
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect(config('services.hrms.url').'/oauth/authorize?'.$query);

    }

    public function callback(Request $request)
    {   

         $response = Http::post(config('services.hrms.url').'/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.hrms.client_id'), // Replace with Client ID
            'client_secret' => config('services.hrms.client_secret'), // Replace with client secret
            'redirect_uri' => config('services.hrms.redirect'),
            'code' => $request->code,
        ]);

         if ($response->status() == '200'){

             $response = Http::withToken($response->object()->access_token)->get(config('services.hrms.url').'/api/user');
    
            if ($response->status() == '200') {

                $user = User::where('email', $response->object()->email)->first();

                $random_passowrd = Str::random(8);
                          
                $user = User::updateOrCreate([
                     'email' => $response->object()->email,
                ],[
                    'name' => $response->object()->name,
                    'password' => Hash::make($random_passowrd),
                ]);
               
            }

            Auth::login($user);
            return redirect()->to('/home');

         }
      
        return redirect('/login');
    }
}

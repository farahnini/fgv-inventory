<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

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
            'client_id' => config('services.hrms.client_id'), 
            'client_secret' => config('services.hrms.client_secret'),
            'redirect_uri' => config('services.hrms.redirect'),
            'code' => $request->code,
        ]);

    if ($response->status() == '200') {
  
        $response = Http::withToken($response->object()->access_token)->get(config('services.hrms.url').'/api/user');
        if ($response->status() == '200') {
            
            $user = User::where('email', $response->object()->email)->first();  
            if(!$user){
                $random_password = Str::random(8);
                $user = User::create([
                    'name' => $response->object()->name,
                    'email' => $response->object()->email,
                    'password' => Hash::make($random_password),
                ]);
            } 

            Auth::login($user);
            return redirect()->to('/home');
        } 
    }

    return redirect('/login');
    }
}

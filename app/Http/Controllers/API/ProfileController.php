<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {   
        // get current user
        $user = auth()->user();
        // return user data
        return response()->json([
            'user' => $user
        ]);
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
}

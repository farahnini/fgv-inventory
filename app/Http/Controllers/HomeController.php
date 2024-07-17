<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InventoryItem;
use Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $available_items = InventoryItem::all();

         $complaints = null;

        // query using http get
        // $complaints = Http::get('https://staging.ecomplaint.tarsoft.my/api/v1/complaints')->object()->data;
        // dd($complaint);

        return view('home', compact('available_items', 'complaints'));
    }
}

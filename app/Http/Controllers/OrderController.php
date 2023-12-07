<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\InventoryItem;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $orders = Order::all();
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'order_status' => 'draft',
        ]);

        $user = auth()->user();

        $details =[
            'title' => 'Order created',
            'message' => 'Select item',
            'url' => url('/'),
        ];

        $user->notify(new OrderNotification($details));

        return redirect()->route('orders.show',$order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {   
        $available_items = InventoryItem::all();
        return view('orders.show',compact('order','available_items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {   
        // Store in item order using M:M relationship
        $order->inventoryItems()->attach($request->item_id,[
            'quantity' => $request->quantity,
        ]);

        // Return redirect route show
        return redirect()->route('orders.show', $order)->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

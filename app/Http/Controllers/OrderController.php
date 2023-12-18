<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Notifications\OrderNotification;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'order_status' => 'draft',
            'user_id' =>auth()->user()->id
        ]);

        $user = auth()->user();

        $details = [
            'title' => 'Order Created!',
            'message' => 'Kindly add more inventory items.',
            'url' => url('/home'),
        ];

        $user->notify(new OrderNotification($details));

        return redirect()->route('orders.show', $order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $available_items = InventoryItem::all();

        return view('orders.show', compact('order', 'available_items'));
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
        // store in item_order using M:M relationship
        $order->inventoryItems()->attach($request->item_id, [
            'quantity' => $request->quantity 
        ]);

        // return redirect route show
        return redirect()->route('orders.show', $order);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function generatePDF(Order $order)
    {
        // resources/views/orders/pdf.blade.php -> $order
        $pdf = Pdf::loadView('orders.pdf', compact('order'))->setPaper('a4', 'landscape');

        return $pdf->download('invoice.pdf');
    }
}

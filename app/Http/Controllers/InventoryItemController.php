<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryCategory;

use Illuminate\Http\Request;
use File;
use Storage;
use Notification;
use App\Notifications\StoreItemNotification;

class InventoryItemController extends Controller
{   

     function __construct()
    {   
        $this->middleware(['permission:item-list|item-create|item-edit|item-delete'], ['only' => ['index']]);
        $this->middleware(['permission:item-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:item-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:item-delete'], ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query all items from tables 'inventory_items' using model InventoryItem
        $inventory_items = InventoryItem::all();

        // return to resources/views/inventory-items/index.blade.php
        return view('inventory-items.index', compact('inventory_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // query all categories using model InventoryCategory
        $inventory_categories = InventoryCategory::all();

        // return create form
        return view('inventory-items.create', compact('inventory_categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store input with mass assignment
        $inventory_item = InventoryItem::create($request->all());

        // create inventory item setting, create using relationship
        $inventory_item_setting = $inventory_item
                                    ->inventoryItemSetting()
                                    ->create([
                                        'minimum_number_item_alert' => 10
                                    ]);

        // upload inv items photo
        if($request->hasFile('image')){
            // rename file 56-2023-11-2.jpeg
            $filename = $inventory_item->id.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();
            // store in storage
            Storage::disk('public')->put($filename, File::get($request->image));

            // update in table
            $inventory_item->update(['image' => $filename]);
        }

        // send notification
        $details = [
            'message' => 'A new item '. $inventory_item->name .' has been added to the inventory.'
        ];

        Notification::send(auth()->user(), new StoreItemNotification($details));

        // return to index
        return redirect()->route('inventory-items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItem)
    {
        // update read_at
        $inventoryItem->unreadNotifications->markAsRead();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        //
    }
}

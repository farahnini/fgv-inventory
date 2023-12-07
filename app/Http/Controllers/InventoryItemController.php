<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use File;
use Storage;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query all items from inventory_items using model InventoryItem
        $inventory_items = InventoryItem::all();

        // return to resources/viewes/inventory-items/index.blade.php
        return view('inventory-items.index',compact('inventory_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        // query all categories using model InventoryCategory
        $inventory_categories = InventoryCategory::all();

        // return create form
        return view('inventory-items.create',compact('inventory_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:inventory_categories,id',
            'description' => 'required|string',
            'weight' => 'required',
            'colour' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'quantity' => 'required|integer',
        ],
            [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'weight.required' => 'The weight field is required.',
            'colour.string' => 'The colour must be a string.',
            'reference_number.string' => 'The reference number must be a string.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
        ]);

        // Create a new InventoryItem instance and fill it with the validated data
        $inventory_item = InventoryItem::create($validatedData);

        $inventory_item_setting = $inventory_item
                                ->inventoryItemSetting()
                                ->create([
                                        'minimum_number_item_alert' => 10
                                ]);

        // upload inv items photo
        if($request->hasFile('image')){
            // rename file
            $filename = $inventory_item->id.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();
            // store in storage
            Storage::disk('public')->put($filename,File::get($request->image));
            // update in table
            $inventory_item->update(['image' => $filename]);
        }

        // Redirect to a success page or route
        return redirect()->route('inventory-items.index')->with('success', 'Inventory item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventory_item)
    {
        return view('inventory-items.show',compact('inventory_item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryItem $inventory_item)
    {
         // query all categories using model InventoryCategory
        $inventory_categories = InventoryCategory::all();

        // return create form
        return view('inventory-items.edit',compact('inventory_categories','inventory_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryItem $inventory_item)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:inventory_categories,id',
            'description' => 'required|string',
            'weight' => 'required',
            'colour' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'quantity' => 'required|integer',
        ],
            [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'weight.required' => 'The weight field is required.',
            'colour.string' => 'The colour must be a string.',
            'reference_number.string' => 'The reference number must be a string.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
        ]);

        // Update the existing InventoryItem instance with the validated data
        $inventory_item->update($validatedData);

        // Upload inventory item photo if a new file is provided
        if ($request->hasFile('image')) {

            // Delete the previous image if it exists
            if ($inventory_item->image) {
                Storage::disk('public')->delete($inventory_item->image);
            }

            // Rename file
            $filename = $inventory_item->id.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();
            // Store in storage
            Storage::disk('public')->put($filename, File::get($request->image));
            // Update in the table
            $inventory_item->update(['image' => $filename]);

        }

        // Redirect to a success page or route
        return redirect()->route('inventory-items.index')->with('success', 'Inventory item updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(InventoryItem $inventory_item)
    {
        // Delete the associated image if it exists
        if ($inventory_item->image) {
            Storage::disk('public')->delete($inventory_item->image);
        }

        // Delete the InventoryItem
        $inventory_item->delete();

        // Redirect to a success page or route
        return redirect()->route('inventory-items.index')->with('success', 'Inventory item deleted successfully');
    }
}

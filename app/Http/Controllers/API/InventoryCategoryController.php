<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryCategory;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $inventory_categories = InventoryCategory::with('inventoryItems')->paginate(3);

        return response()->json([
            'message' => 'Successfuly retrieved inventory categories',
            'data' => $inventory_categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $inventory_category = InventoryCategory::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Inventory category created successfully',
            'data' => $inventory_category
        ]);
    }


}

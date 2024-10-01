<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryCategory;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $inventoryCategories = InventoryCategory::with('inventoryItems')->paginate(3);

        return response()->json([
            'message' => 'Successfully retrieved inventory categories',
            'data' => $inventoryCategories
        ], 200);
    }

    public function show($inventoryCategory)
    {
        $inventoryCategory = InventoryCategory::find($inventoryCategory);

        if (!$inventoryCategory) {
            return response()->json([
                'message' => 'Inventory category not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved inventory category',
            'data' => $inventoryCategory
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $inventoryCategory = InventoryCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Inventory category created successfully',
            'data' => $inventoryCategory
        ], 201);

    }

    public function update(Request $request, $inventoryCategory)
    {
        $inventoryCategory = auth()->user()->inventoryCategories()->find($inventoryCategory);

        if (!$inventoryCategory) {
            return response()->json([
                'message' => 'Inventory category not found'
            ], 404);
        }

        $inventoryCategory->update($request->all());

        return response()->json([
            'message' => 'Inventory category updated successfully',
            'data' => $inventoryCategory
        ], 200);
    }

    public function delete($inventoryCategory)
    {
        $inventoryCategory = auth()->user()->inventoryCategories()->find($inventoryCategory);

        if (!$inventoryCategory) {
            return response()->json([
                'message' => 'Inventory category not found'
            ], 404);
        }

        $inventoryCategory->delete();

        return response()->json([
            'message' => 'Inventory category deleted successfully'
        ], 200);
    }
}

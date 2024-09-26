<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryCategory;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $inventory_categories = InventoryCategory::paginate(3);

        return response()->json([
            'message' => 'Successfuly retrieved inventory categories',
            'data' => $inventory_categories
        ]);
    }
}

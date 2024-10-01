<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InventoryCategoryController extends Controller
{   
    function __construct()
    {   
        $this->middleware(['permission:category-list|category-create|category-edit|category-delete'], ['only' => ['index']]);
        $this->middleware(['permission:category-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:category-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:category-delete'], ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory_categories = InventoryCategory::All();

         // Return view with users data
        return view('inventory-categories.index',compact('inventory_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
        // ], 
        //     ['name.required' => 'The name field is required.',
        //     'name.max' => 'The name may not be greater than :max characters.',
        //     'description.required' => 'The description field is required.',
        //     'image.required' => 'The image field is required.',
        //     'image.image' => 'The uploaded file must be an image.',
        //     'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        //     'image.max' => 'The image may not be greater than :max kilobytes.',]
        // );

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // You should configure the proper storage location
        } else {
            $imageName = ''; // Set a default image name if no image is uploaded
        }

        // Create a new Inventory Category
        $inventoryCategory = new InventoryCategory();
        $inventoryCategory->name = $request->input('name');
        $inventoryCategory->description = $request->input('description');
        $inventoryCategory->image = $imageName; // Store the image filename in the database


        if ($request->hasFile('images')) {
            // store multiple images using spatie
            $inventoryCategory->addMultipleMediaFromRequest(['images'])
                            ->each(function ($fileAdder) {
                                $fileAdder->toMediaCollection('category_images');
                            });
        }


        flash()->addSuccess('Category registered successfully');

        // Save the Inventory Category
        $inventoryCategory->save();

        // Redirect to the users index page with a success message
        return redirect()->route('inventory-categories.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryCategory $inventory_category)
    {
         return view('inventory-categories.show',compact('inventory_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryCategory $inventory_category)
    {
        $this->authorize('update', $inventory_category);

         return view('inventory-categories.edit',compact('inventory_category'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryCategory $inventory_category)
    {
        $this->authorize('update', $inventory_category);

        // Validate the incoming data for updating
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // You should configure the proper storage location
            $inventory_category->image = $imageName; // Update the image filename in the database
        }

        // Update the Inventory Category with the new data
        $inventory_category->name = $request->input('name');
        $inventory_category->description = $request->input('description');
        $inventory_category->save();

        flash()->addSuccess('Category updated successfully');

        // Redirect to the inventory categories index page with a success message
        return redirect()->route('inventory-categories.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(InventoryCategory $inventory_category)
    {
        try {
            // Get the image file name
            $imageFileName = $inventory_category->image;

            // Delete the inventory category record from the database
            $inventory_category->delete();

            // Delete the associated image file from the public/images folder
            $imagePath = public_path('images/' . $imageFileName);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            flash()->addSuccess('Category deleted successfully');
        } catch (\Exception $e) {
            flash()->addError('Error deleting category: ' . $e->getMessage());
        }

        // Redirect to the inventory categories index page
        return redirect()->route('inventory-categories.index');
    }
}

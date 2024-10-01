<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $available_items = \App\Models\InventoryItem::all();

    $cart_products = collect(request()->session()->get('cart'));

    $cart_total = 0;
    if(session('cart')){
        foreach ($cart_products as $key => $product) {
            
            $cart_total+= $product['quantity'];
        }
    }
    return view('welcome', compact('available_items', 'cart_products', 'cart_total'));
});

Route::get('/oauth/google/redirect', [App\Http\Controllers\SSO\GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/oauth/google/callback', [App\Http\Controllers\SSO\GoogleController::class, 'callback'])->name('google.callback');

Route::get('/oauth/github/redirect', [App\Http\Controllers\SSO\GitHubController::class, 'redirect'])->name('github.redirect');
Route::get('/oauth/github/callback', [App\Http\Controllers\SSO\GitHubController::class, 'callback'])->name('github.callback');

Route::get('/oauth/hrms/redirect', [App\Http\Controllers\SSO\HRMSController::class, 'redirect'])->name('hrms.redirect');
Route::get('/oauth/hrms/callback', [App\Http\Controllers\SSO\HRMSController::class, 'callback'])->name('hrms.callback');


Route::post('/carts/add/{available_item}', function (Request $request, InventoryItem $available_item) {

    $item = $available_item;
    $cart = session('cart', []);
    
    if(isset($cart[$item->id])) {
        $cart[$item->id]['quantity'] = $cart[$item->id]['quantity'] + $request->quantity;
    } else {
        $cart[$item->id] = [
            "name" => $item->name,
            "quantity" => $request->quantity,
            "image" => $item->image_url
        ];
    }

    $request->session()->put('cart', $cart);


    return redirect('/');
})->name('carts.add');

Route::get('clear-cart', function() {
    session()->forget('cart');

    return redirect('/');
})->name('carts.clear');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users',[UserController::class,'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/create', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{user:uuid}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
Route::get('/users/{user:uuid}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/users/{user:uuid}/edit', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/users/{user:uuid}/delete',[UserController::class,'delete'])->name('users.delete')->middleware('auth');

Route::get('/inventory-categories',[InventoryCategoryController::class,'index'])->name('inventory-categories.index')->middleware('auth');
Route::get('/inventory-categories/create', [InventoryCategoryController::class, 'create'])->name('inventory-categories.create')->middleware('auth');
Route::post('/inventory-categories/create', [InventoryCategoryController::class, 'store'])->name('inventory-categories.store')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}/show', [InventoryCategoryController::class, 'show'])->name('inventory-categories.show')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}/edit', [InventoryCategoryController::class, 'edit'])->name('inventory-categories.edit')->middleware('auth');
Route::post('/inventory-categories/{inventory_category}/edit', [InventoryCategoryController::class, 'update'])->name('inventory-categories.update')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}/delete',[InventoryCategoryController::class,'delete'])->name('inventory-categories.delete')->middleware('auth');

Route::get('/inventory-items', [InventoryItemController::class, 'index'])->name('inventory-items.index');
Route::get('/inventory-items/create', [InventoryItemController::class, 'create'])->name('inventory-items.create')->middleware('auth');
Route::post('/inventory-items/create', [InventoryItemController::class, 'store'])->name('inventory-items.store')->middleware('auth');

Route::get('/orders/create', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
// Routing to download PDF
Route::get('/orders/{order}/generate-pdf', [OrderController::class, 'generatePDF'])->name('orders.generate-pdf');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');

Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
Route::post('/roles/create',[RoleController::class,'store'])->name('roles.store');
Route::get('/roles/{role}',[RoleController::class,'show'])->name('roles.show');
Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('roles.edit');
Route::post('/roles/{role}/edit',[RoleController::class,'update'])->name('roles.update');

// Permissions
Route::get('/permissions',[PermissionController::class,'index'])->name('permissions.index');
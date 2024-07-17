<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users',[UserController::class,'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/create', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/users/{user}/delete',[UserController::class,'delete'])->name('users.delete')->middleware('auth');

Route::get('/inventory-categories',[InventoryCategoryController::class,'index'])->name('inventory-categories.index')->middleware('auth');
Route::get('/inventory-categories/create', [InventoryCategoryController::class, 'create'])->name('inventory-categories.create')->middleware('auth');
Route::post('/inventory-categories/create', [InventoryCategoryController::class, 'store'])->name('inventory-categories.store')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}', [InventoryCategoryController::class, 'show'])->name('inventory-categories.show')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}/edit', [InventoryCategoryController::class, 'edit'])->name('inventory-categories.edit')->middleware('auth');
Route::post('/inventory-categories/{inventory_category}/edit', [InventoryCategoryController::class, 'update'])->name('inventory-categories.update')->middleware('auth');
Route::get('/inventory-categories/{inventory_category}/delete',[InventoryCategoryController::class,'delete'])->name('inventory-categories.delete')->middleware('auth');

Route::get('/inventory-items',[InventoryItemController::class,'index'])->name('inventory-items.index')->middleware('auth');
Route::get('/inventory-items/create', [InventoryItemController::class, 'create'])->name('inventory-items.create')->middleware('auth');
Route::post('/inventory-items/create', [InventoryItemController::class, 'store'])->name('inventory-items.store')->middleware('auth');
Route::get('/inventory-items/{inventory_item}', [InventoryItemController::class, 'show'])->name('inventory-items.show')->middleware('auth');
Route::get('/inventory-items/{inventory_item}/edit', [InventoryItemController::class, 'edit'])->name('inventory-items.edit')->middleware('auth');
Route::post('/inventory-items/{inventory_item}/edit', [InventoryItemController::class, 'update'])->name('inventory-items.update')->middleware('auth');
Route::get('/inventory-items/{inventory_item}/delete',[InventoryItemController::class,'delete'])->name('inventory-items.delete')->middleware('auth');

Route::get('/orders',[OrderController::class,'index'])->name('orders.index')->middleware('auth');
Route::get('/orders/create', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');
Route::post('/orders/{order}', [OrderController::class, 'update'])->name('orders.show')->middleware('auth');
//Routing to download pdf
Route::get('/orders/{order}/generate-pdf', [OrderController::class, 'generatePDF'])->name('orders.generate-pdf');

// Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware('auth');
// Route::post('/orders/{order}/edit', [OrderController::class, 'update'])->name('orders.update')->middleware('auth');
// Route::get('/orders/{order}/delete',[OrderController::class,'delete'])->name('orders.delete')->middleware('auth');


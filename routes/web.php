<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\OrderController;

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

    return view('welcome', compact('available_items'));
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

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::get('/profile', [App\Http\Controllers\API\AuthController::class, 'profile'])->middleware('auth:api');
Route::get('/logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:api');

Route::get('/notifications', [App\Http\Controllers\API\NotificationController::class, 'index'])->middleware('auth:api');
Route::get('/notifications/{notification}', [App\Http\Controllers\API\NotificationController::class, 'show'])->middleware('auth:api');
Route::get('/notifications/{notification}/delete', [App\Http\Controllers\API\NotificationController::class, 'destroy'])->middleware('auth:api');
Route::get('/notifications/delete/all', [App\Http\Controllers\API\NotificationController::class, 'destroyAll'])->middleware('auth:api');

Route::get('/inventory-categories', [App\Http\Controllers\API\InventoryCategoryController::class, 'index'])->middleware('auth:api');
<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function() {

    // Logout Route
    Route::get('logout', [AuthController::class, 'logout']);

    // Category Routes
    Route::middleware('role:admin')->group(function() {

        // Category List Route
        Route::get('categories', [CategoryController::class, 'index']);

        // Category CRUD Routes
        Route::prefix('category')->group(function() {
            Route::post('create', [CategoryController::class, 'store']);
            Route::put('update', [CategoryController::class, 'update']);
            Route::delete('delete', [CategoryController::class, 'destroy']);
        });

    });

});

Route::get('check', function () {
    return response()->json([
        'message' => 'Running',
    ], 200);
});
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

        // Category CRUD Routes
        Route::prefix('category')->group(function() {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('{id}', [CategoryController::class, 'update']);
            Route::delete('{id}', [CategoryController::class, 'destroy']);
        });

        // User CRUD Routes
        Route::prefix('user')->group(function() {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::put('{id}', [UserController::class, 'update']);
            Route::delete('{id}', [UserController::class, 'destroy']);
        });

        // Role CRUD Routes
        Route::prefix('role')->group(function() {
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/', [RoleController::class, 'store']);
            Route::put('{id}', [RoleController::class, 'update']);
            Route::delete('{id}', [RoleController::class, 'destroy']);
        });


    });

});
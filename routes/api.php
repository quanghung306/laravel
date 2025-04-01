<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//  route yêu cầu xác thực (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::post('/', [UsersController::class, 'store']);
        Route::get('/{id}', [UsersController::class, 'show']);
        Route::put('/{id}', [UsersController::class, 'update']);
        Route::delete('/{id}', [UsersController::class, 'destroy']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

//   route Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

//   route Category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);

    // Route phụ của Category
    Route::get('/{id}/children', [CategoryController::class, 'children']);
    Route::get('/{id}/products', [CategoryController::class, 'products']);
});

//   route Product
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);

    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
});

//  route Cart
Route::prefix('carts')->group(function () {
    Route::get('/', [CartsController::class, 'index']);
    Route::post('/', [CartsController::class, 'store']);
    Route::get('/{id}', [CartsController::class, 'show']);
    Route::put('/{id}', [CartsController::class, 'update']);
    Route::delete('/{id}', [CartsController::class, 'destroy']);
});

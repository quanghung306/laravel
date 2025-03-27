<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Import ProductController
use App\Http\Controllers\UsersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('category/{id}/children', [CategoryController::class, 'children']);
Route::get('category/{id}/products', [CategoryController::class, 'products']);

// Route::get('/products', [ProductController::class, 'index']); // Lấy danh sách sản phẩm
// Route::post('products', [ProductController::class, 'store']); // Thêm mới sản phẩm
Route::apiResource('products', ProductController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('carts', CartsController::class);
Route::apiResource('users', UsersController::class);


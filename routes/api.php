<?php
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Middleware bảo vệ API với Sanctum
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Category
// Lấy danh sách danh mục
Route::get('category', [CategoryController::class, 'index']);
// Thêm mới danh mục
Route::post('category', [CategoryController::class, 'store']);
// Xem chi tiết danh mục
Route::get('category/{id}', [CategoryController::class, 'show']);
// Cập nhật danh mục
Route::put('category/{id}-23', [CategoryController::class, 'update']);
// Xóa danh mục
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

// Route phụ cho danh mục
Route::get('category/{id}/children', [CategoryController::class, 'children']); // Lấy danh mục con
Route::get('products/{id}/category', [CategoryController::class, 'products']); // Lấy sản phẩm trong danh mục

// Product
Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);

// Cart
Route::get('carts', [CartsController::class, 'index']);
Route::post('carts', [CartsController::class, 'store']);
Route::get('carts/{id}', [CartsController::class, 'show']);
Route::put('carts/{id}', [CartsController::class, 'update']);

Route::delete('carts/{id}', [CartsController::class, 'destroy']);

// Users
Route::get('users', [UsersController::class, 'index']);
Route::post('users', [UsersController::class, 'store']);
Route::get('users/{id}', [UsersController::class, 'show']);
Route::put('users/{id}', [UsersController::class, 'update']);
Route::delete('users/{id}', [UsersController::class, 'destroy']);

// home
Route::get('/home', [HomeController::class, 'index']);

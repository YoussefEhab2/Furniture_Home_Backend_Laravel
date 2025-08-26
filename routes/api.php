<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Admin-only
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin']);
    })->middleware('role:admin');

    Route::post('/product', [ProductController::class, 'store'])->middleware('role:admin');
    Route::put('/product/{id}', [ProductController::class, 'update'])->middleware();
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->middleware('role:admin');

    Route::post('/categories', [CategoryController::class, 'store'])->middleware('role:admin');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('role:admin');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('role:admin');    
    // Customer-only

    Route::get('/customer/area', function () {
        return response()->json(['message' => 'Welcome Customer']);
    })->middleware('role:customer');
    Route::post('/review/{product_id}', [ReviewController::class, 'store'])->middleware('role:customer');

    Route::post('/cart/{product_id}', [CartController::class, 'addToCart'])->middleware('role:customer');
    Route::delete('/cart/{product_id}', [CartController::class, 'removeFromCart'])->middleware('role:customer');
    Route::put('/cart/{product_id}', [CartController::class, 'editItem'])->middleware('role:customer');

    //
    Route::post('/favourite/{product_id}', [FavouriteController::class, 'addToFavourites']);
    Route::delete('/favourite/{product_id}', [FavouriteController::class, 'removeFromFavourites']);
    Route::get('/favourite', [FavouriteController::class, 'getFavourites']);
});


Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);






Route::get('/categories', [CategoryController::class, 'index']);



Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProducts']);





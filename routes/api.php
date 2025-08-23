<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Admin-only
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin']);
    })->middleware('role:admin');

    // Customer-only
    Route::get('/customer/area', function () {
        return response()->json(['message' => 'Welcome Customer']);
    })->middleware('role:customer');
});


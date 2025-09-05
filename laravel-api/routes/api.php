<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\GroceryController;

Route::prefix('auth')->group(function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('social/{provider}', [SocialAuthController::class, 'socialLogin']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    // Users CRUD (admin-only)
    Route::middleware('isAdmin')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::post('users', [UserController::class, 'store']);
        Route::put('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);

        // Admin-only management endpoints
        Route::get('admin/users', [UserAdminController::class, 'index']);
        Route::put('admin/users/{user}', [UserAdminController::class, 'update']);
        Route::delete('admin/users/{user}', [UserAdminController::class, 'destroy']);
    });

    // Tasks for logged-in user
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/', [TaskController::class, 'store']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
        Route::patch('/{id}/complete', [TaskController::class, 'complete']);
    });

    // Grocery read-only endpoints
    Route::prefix('grocery')->group(function () {
        Route::get('/categories', [GroceryController::class, 'categories']);
        Route::get('/categories/{id}/items', [GroceryController::class, 'categoryItems']);
    });
});


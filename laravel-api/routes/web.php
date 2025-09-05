<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\TaskAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ItemAdminController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Auth (web guard)
Route::middleware('web')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth');
});

// Admin Panel (only for role admin or super_admin)
Route::prefix('admin')->middleware(['web', 'session.expiry', 'auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/users', [\App\Http\Controllers\Admin\UserAdminController::class, 'index']);
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserAdminController::class, 'create']);
    Route::post('/users', [\App\Http\Controllers\Admin\UserAdminController::class, 'store']);
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserAdminController::class, 'edit']);
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserAdminController::class, 'update']);
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserAdminController::class, 'destroy']);
    Route::post('/users/{id}/make-admin', [ManageUsersController::class, 'makeAdmin']);
    Route::post('/users/{id}/remove-admin', [ManageUsersController::class, 'removeAdmin']);

    // Tasks management
    Route::get('/tasks', [TaskAdminController::class, 'index']);
    Route::get('/tasks/create', [TaskAdminController::class, 'create']);
    Route::post('/tasks', [TaskAdminController::class, 'store']);
    Route::get('/tasks/{task}/edit', [TaskAdminController::class, 'edit']);
    Route::put('/tasks/{task}', [TaskAdminController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskAdminController::class, 'destroy']);
    Route::post('/tasks/{task}/complete', [TaskAdminController::class, 'complete']);

    // Grocery (restrict optionally to super admin with isSuperAdmin if needed)
    Route::prefix('grocery')->group(function () {
        // Categories
        Route::get('/categories', [CategoryAdminController::class, 'index']);
        Route::get('/categories/create', [CategoryAdminController::class, 'create']);
        Route::post('/categories', [CategoryAdminController::class, 'store']);
        Route::get('/categories/{category}/edit', [CategoryAdminController::class, 'edit']);
        Route::put('/categories/{category}', [CategoryAdminController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryAdminController::class, 'destroy']);

        // Items
        Route::get('/items', [ItemAdminController::class, 'index']);
        Route::get('/items/create', [ItemAdminController::class, 'create']);
        Route::post('/items', [ItemAdminController::class, 'store']);
        Route::get('/items/{item}/edit', [ItemAdminController::class, 'edit']);
        Route::put('/items/{item}', [ItemAdminController::class, 'update']);
        Route::delete('/items/{item}', [ItemAdminController::class, 'destroy']);
    });
});

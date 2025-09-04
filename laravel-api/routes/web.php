<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUsersController;

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
Route::prefix('admin')->middleware(['web', 'auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/users', [ManageUsersController::class, 'index']);
    Route::get('/users/{id}/edit', [ManageUsersController::class, 'edit']);
    Route::post('/users/{id}/make-admin', [ManageUsersController::class, 'makeAdmin']);
    Route::post('/users/{id}/remove-admin', [ManageUsersController::class, 'removeAdmin']);
});

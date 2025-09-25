<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
    
    Route::get('/users/create', function () {
        return view('admin.users.create');
    })->name('users.create');
    
    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('products.index');
    
    Route::get('/orders', function () {
        return view('admin.orders.index');
    })->name('orders.index');
    
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});
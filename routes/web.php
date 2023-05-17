<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;

Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [userController::class, 'index'])->name('index');
Route::get('/users/get_users_data', [UserController::class, 'get_users_data'])->name('get_users_data');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
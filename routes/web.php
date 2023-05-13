<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;

Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [UserController::class, 'index'])->name('index');
Route::get('/users/get_users_data', [UserController::class, 'get_users_data'])->name('get_users_data');
Route::post('/users/create_user', [UserController::class, 'create_user'])->name('create_user');
Route::get('/users/get_single_user', [UserController::class, 'get_single_user'])->name('get_single_user');
Route::post('/users/update_user', [UserController::class, 'update_user'])->name('update_user');
Route::get('/users/delete_user', [UserController::class, 'delete_user'])->name('delete_user');

Route::post('/users/save_address', [UserController::class, 'save_address'])->name('save_address');
Route::get('/users/get_user_addresses', [UserController::class, 'get_user_addresses'])->name('get_user_addresses');
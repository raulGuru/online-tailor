<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', HomeController::class);
Route::resource('category', CategoryController::class);
Route::get('/appointment', function() {
    return view('layouts.appointment');
});
Route::resource('admin/login', LoginController::class)->middleware(EnsureTokenIsValid::class);
Route::post('admin/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::resource('user', UserController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('product', ProductController::class);
Route::post('product/remove_image/{id}', [ProductController::class, 'remove_image'])->name('product.remove_image');
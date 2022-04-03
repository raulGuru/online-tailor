<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function() {
    return view('layouts.front');
});
Route::get('/appointment', function() {
    return view('layouts.appointment');
});

Route::resource('/', LoginController::class);
Route::resource('login', LoginController::class);
Route::post('logout', [LoginController::class, 'logout'])->name('login.logout');
Route::resource('signup', SignupController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('product', ProductController::class);
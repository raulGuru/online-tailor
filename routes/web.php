<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerSignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StitchingController;
use App\Http\Controllers\TailorController;
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
Route::resource('home', HomeController::class);
Route::resource('category', CategoryController::class);
Route::resource('login', CustomerLoginController::class);
Route::resource('signup', CustomerSignupController::class, ['names' => 'signup']);
Route::get('account/orders', [CustomerAccountController::class, 'orders'])->name('account.orders');
Route::get('account/address', [CustomerAccountController::class, 'address'])->name('account.address');
Route::resource('account', CustomerAccountController::class);
Route::resource('admin/login', LoginController::class, ['names' => 'admin.login'])->middleware(EnsureTokenIsValid::class);
Route::post('admin/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::resource('user', UserController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('product', ProductController::class);
Route::post('product/remove_image/{id}', [ProductController::class, 'remove_image'])->name('product.remove_image');
route::resource('tailors', TailorController::class);
Route::post('tailors/remove_image/{id}', [TailorController::class, 'remove_image'])->name('tailor.remove_image');
Route::resource('stitching', StitchingController::class);
Route::resource('appointment', AppointmentController::class);
Route::get('get_appointment/{id}', [AppointmentController::class, 'get_appointment']);
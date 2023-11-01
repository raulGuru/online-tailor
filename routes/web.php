<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerSignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StitchingController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSubCategoryController;
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
Route::post('product/tailor_change', [ProductController::class, 'tailor_change']);
Route::resource('product', ProductController::class);
Route::post('product/remove_image/{id}', [ProductController::class, 'remove_image'])->name('product.remove_image');
Route::post('product/get_subcategory', [ProductController::class, 'get_subcategory'])->name('product.get_subcategory');
route::resource('tailors', TailorController::class);
Route::post('tailors/remove_image/{id}', [TailorController::class, 'remove_image'])->name('tailor.remove_image');
Route::resource('stitching', StitchingController::class);
Route::get('appointment/list', [AppointmentController::class, 'list'])->name('appointment.list');
Route::resource('appointment', AppointmentController::class);
Route::get('get_appointment/{id}', [LocationController::class, 'get_appointment']);
Route::get('location/list', [LocationController::class, 'list'])->name('location.list');
Route::post('location/list', [LocationController::class, 'list'])->name('location.list');
Route::post('location/send_notification', [LocationController::class, 'send_notification'])->name('location.send_notification');
Route::resource('location', LocationController::class);
Route::resource('measurement', MeasurementController::class);
Route::post('measurement/get_fields', [MeasurementController::class, 'get_fields'])->name('measurement.get_fields');
Route::post('measurement/save_measurement', [MeasurementController::class, 'save_measurement'])->name('measurement.save_measurement');
Route::post('measurement/book_tailor', [MeasurementController::class, 'book_tailor'])->name('measurement.book_tailor');
Route::get('order/list', [OrderController::class, 'list'])->name('order.list');
Route::get('payment/list', [OrderController::class, 'paymentList'])->name('order.paymentList');
Route::get('order_view/{id}', [OrderController::class, 'order_view'])->name('order.order_view');
Route::resource('order', OrderController::class);
Route::resource('product_category', ProductCategoryController::class);
Route::post('product_category/update_status', [ProductCategoryController::class, 'update_status'])->name('product_category.update_status');
Route::resource('product_subcategory', ProductSubCategoryController::class);
Route::post('product_subcategory/update_status', [ProductSubCategoryController::class, 'update_status'])->name('product_subcategory.update_status');
Route::post('process_payment', [OrderController::class, 'make_payment'])->name('order.make_payment');
Route::get('payment_response', [OrderController::class, 'payment_response'])->name('order.payment_response');
Route::webhooks('payment_wehook','payment_wehook');

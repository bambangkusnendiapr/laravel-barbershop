<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;

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

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('/locationToService/{id}', [FrontController::class, 'locationToService'])->name('locationToService');

Route::get('/add-to-cart/{id}', [FrontController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/delete-service/{id}', [FrontController::class, 'deleteService'])->name('deleteService');
Route::patch('update-cart', [FrontController::class, 'update']);

Route::get('/staff', [FrontController::class, 'staff'])->name('staff');
Route::post('/staff', [FrontController::class, 'addStaff'])->name('addStaff');

Route::get('/customer', [FrontController::class, 'customer'])->name('customer');
Route::post('/customer', [FrontController::class, 'addCustomer'])->name('addCustomer');

Route::get('/detail', [FrontController::class, 'detail'])->name('detail');

Route::post('/payment', [FrontController::class, 'addPayment'])->name('addPayment');
Route::get('/detail-payment/{kode}', [FrontController::class, 'detail_payment'])->name('detail_payment');
Route::put('/upload-bukti/{id}', [FrontController::class, 'uploadBukti'])->name('uploadBukti');

Route::get('/unset-cart', [FrontController::class, 'unsetCart'])->name('unsetCart');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'addOrder'])->name('add.order');
Route::get('/booking', [HomeController::class, 'checkBooking'])->name('check.booking');
Route::post('/booking', [HomeController::class, 'bookingCheck'])->name('booking.check');
Route::get('/booking/{kode}', [HomeController::class, 'booking'])->name('booking');
Route::put('/lunas/{id}', [HomeController::class, 'lunas'])->name('lunas');

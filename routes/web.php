<?php

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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'addOrder'])->name('add.order');
Route::get('/booking', [App\Http\Controllers\HomeController::class, 'checkBooking'])->name('check.booking');
Route::post('/booking', [App\Http\Controllers\HomeController::class, 'bookingCheck'])->name('booking.check');
Route::get('/booking/{kode}', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking');
Route::put('/lunas/{id}', [App\Http\Controllers\HomeController::class, 'lunas'])->name('lunas');

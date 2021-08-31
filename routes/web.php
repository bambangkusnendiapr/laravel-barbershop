<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\LaporanController;

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

Route::get('/search-code', [FrontController::class, 'search_code'])->name('search.code');

Route::get('/unset-cart', [FrontController::class, 'unsetCart'])->name('unsetCart');

Auth::routes();

// Route::get('home', 'HomeController@index')->name('home');
Route::get('/home', function() {
  return redirect()->route('dashboard');
});

Route::get('/password/email', function() {
  return redirect()->route('dashboard');
});

Route::get('/password/reset', function() {
  return redirect()->route('dashboard');
});
Route::get('/register', function() {
  return redirect()->route('dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

  Route::middleware(['role:superadmin|owner|staff'])->group(function () {
    //staff
    Route::resource('order', OrderController::class);

    Route::get('order/approve/{id}', [OrderController::class, 'approve'])->name('order.approve');
  
    Route::post('add-service', [OrderController::class, 'add_service'])->name('add_service');
    Route::delete('hapus-service/{id}', [OrderController::class, 'hapus_service'])->name('service.hapus');
    Route::put('update-service/{id}', [OrderController::class, 'update_service'])->name('update_service');
  });

  Route::middleware(['role:superadmin|owner'])->group(function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
    Route::resources([
      'location' => LocationController::class,
      'service' => ServiceController::class,
      'category' => CategoryController::class,
      'payment' => PaymentController::class,
      'staff' => StaffController::class,
    ]);

    //Laporan
    //pelayanan
    Route::post('laporan-pelayanan', [LaporanController::class, 'pelayanan'])->name('laporan.pelayanan');

    //staff
    Route::post('laporan-staff', [LaporanController::class, 'staff'])->name('laporan.staff');
  
  });

  
      
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'addOrder'])->name('add.order');
Route::get('/booking', [HomeController::class, 'checkBooking'])->name('check.booking');
Route::post('/booking', [HomeController::class, 'bookingCheck'])->name('booking.check');
Route::get('/booking/{kode}', [HomeController::class, 'booking'])->name('booking');
Route::put('/lunas/{id}', [HomeController::class, 'lunas'])->name('lunas');

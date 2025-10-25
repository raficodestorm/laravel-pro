<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SearchScheduleBusController;
use App\Http\Controllers\SeatReservationController;
use App\Http\Controllers\PaymentController;







Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/admindashboard', function () {
    return view('pages.admin.admindashboard');
})->name('pages.admin.admindashboard');


Route::resource('buses', BusController::class);
Route::resource('locations', LocationController::class);

// Route::get('/locations/get', [RouteController::class, 'getLocationss'])->name('locations.create');
// Route::get('/locations/get', [RouteController::class, 'getLocationss'])->name('locations.get');
Route::resource('routes', RouteController::class);

// ------------------------for bus schedule----------------------------------------
Route::resource('schedules', ScheduleController::class);
Route::get('/get-route-info', [ScheduleController::class, 'getRouteInfo'])->name('get.route.info');
Route::get('/get-coaches', [ScheduleController::class, 'getCoachesByBusType'])->name('get.coaches');

// ------------------------for search chedule bus ----------------------------------------
Route::get('/locations/search', [SearchScheduleBusController::class, 'getLocations'])->name('locations.get');
Route::get('/', [SearchScheduleBusController::class, 'index'])->name('bus.search.form');
Route::post('/find-bus', [SearchScheduleBusController::class, 'search'])->name('bus.search');

// ------------------------for seat Reservation ----------------------------------------
Route::get('/seat-reservation/{id}', [SeatReservationController::class, 'see'])->name('seat.reservation');
Route::post('/go-to-payment', [SeatReservationController::class, 'store'])->name('go.payment');

// ------------------------for Payment ----------------------------------------
Route::get('/payment/{id}', [PaymentController::class, 'showPaymentPage'])->name('payment.for');
Route::post('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

// ------------------------for Payment ----------------------------------------
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/ticket', function () {
    // $bookingData = session('bookingData');
    // if (!$bookingData) {
    //     return redirect()->route('home')->with('error', 'No ticket data found!');
    // }
    return view('pages.user.ticket', compact('bookingData'));
})->name('user.ticket');

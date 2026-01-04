<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Counter\CounterTicketController;
use App\Http\Controllers\Counter\PayController;
use App\Http\Controllers\Counter\SearchBusController;
use App\Http\Controllers\Counter\ReservationController;


Route::prefix('counter')->name('counter.')->middleware(['auth', 'role:counter'])->group(function () {
  Route::get('/searchbus', [SearchBusController::class, 'index'])->name('searchbus');
  Route::post('/find-bus', [SearchBusController::class, 'search'])->name('bus.search');
  Route::get('/seat-reservation/{id}', [ReservationController::class, 'see'])->name('seat.reservation');
  Route::post('/go-to-payment', [ReservationController::class, 'store'])->name('go.payment');

  Route::get('/payment/{id}', [PayController::class, 'showPaymentPage'])->name('payment.for');

  Route::get('/ticket', [CounterTicketController::class, 'show'])->name('ticket');
  Route::post('/payment/process', [PayController::class, 'processPayment'])->name('payment.process');
});

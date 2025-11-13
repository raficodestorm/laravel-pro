<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserBookingController;


Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {

    Route::get('/my-tickets', [UserController::class, 'myTickets'])->name('mytickets');
    Route::get('/ticket/view/{ticket}', [UserController::class, 'viewTicket'])->name('ticket.view');
    Route::get('/my-bookings', [UserBookingController::class, 'index'])->name('mybookings');


    Route::get('/bookings/active', [UserBookingController::class, 'active'])->name('bookings.active');
    Route::get('/bookings/pending', [UserBookingController::class, 'pending'])->name('bookings.pending');
    Route::get('/trips/upcoming', [UserBookingController::class, 'upcoming'])->name('trips.upcoming');
    Route::get('/trips/completed', [UserBookingController::class, 'completed'])->name('trips.completed');
});

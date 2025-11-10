<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\SeatReservationController;
use App\Http\Controllers\User\SearchScheduleBusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;

// Route::get('/', function () {
//     return view('pages.user.userfront');
// })->name('user-main-page');

// ------------------------for search chedule bus ----------------------------------------
// Route::get('/locations/search', [SearchScheduleBusController::class, 'getLocations'])->name('locations.get');
Route::get('/', [SearchScheduleBusController::class, 'index'])->name('main.portal');
Route::post('/find-bus', [SearchScheduleBusController::class, 'search'])->name('bus.search');

// ------------------------for seat Reservation ----------------------------------------
Route::get('/seat-reservation/{id}', [SeatReservationController::class, 'see'])->name('seat.reservation');
Route::post('/go-to-payment', [SeatReservationController::class, 'store'])->name('go.payment');

// dashboards (protected)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards');

    Route::get('/dashboard/user', function () {
        return view('pages.dashboard.user');
    })->name('dashboard.user')->middleware('role:user'); // user page - accessible by user (admin can also view if needed)

    Route::get('/dashboard/manager', function () {
        return view('pages.dashboard.counter_manager');
    })->name('dashboard.counter_manager')->middleware('role:counter_manager');

    Route::get('/dashboard/controller', function () {
        return view('pages.dashboard.controller');
    })->name('dashboard.controller')->middleware('role:controller');

    Route::get('/dashboard/admin', function () {
        return view('pages.dashboard.admin');
    })->name('dashboard.admin')->middleware('role:admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update Profile Information
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete Account (optional, if you want to keep Breeze's delete)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/payment/{id}', [PaymentController::class, 'showPaymentPage'])->name('payment.for');

    Route::get('/ticket', [TicketController::class, 'show'])->name('user.ticket');


    // Route::post('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
    // Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
});



require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/manager.php';
require __DIR__ . '/controller.php';

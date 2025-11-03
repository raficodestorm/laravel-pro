<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PaymentController;


Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    // ------------------------for Payment ----------------------------------------
Route::get('/payment/{id}', [PaymentController::class, 'showPaymentPage'])->name('payment.for');
Route::post('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
// Route::get('/ticket', function () {
    // $bookingData = session('bookingData');
    // if (!$bookingData) {
    //     return redirect()->route('home')->with('error', 'No ticket data found!');
    // } , compact('bookingData')
//     return view('pages.user.ticket');
// })->name('user.ticket');



});

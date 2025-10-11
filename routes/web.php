<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;

Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/admindashboard', function () {
    return view('pages.admin.admindashboard');
})->name('pages.admin.admindashboard');


// Route::get('/all-buses', function () {
//     return view('pages.admin.bus.index');
// })->name('buses.index');

Route::resource('buses', BusController::class);

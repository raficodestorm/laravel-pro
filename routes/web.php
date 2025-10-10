<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\BusController;

Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/admindashboard', function () {
    return view('pages.admin.admindashboard');
});

Route::get('/all-buses', function () {
    return view('pages.admin.bus.index');
});

Route::resource('buses', BusController::class);

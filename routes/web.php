<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;


Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/admindashboard', function () {
    return view('pages.admin.admindashboard');
})->name('pages.admin.admindashboard');

Route::resource('buses', BusController::class);
Route::resource('locations', LocationController::class);
Route::resource('routes', RouteController::class);

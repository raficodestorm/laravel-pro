<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SearchScheduleBusController;





Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/admindashboard', function () {
    return view('pages.admin.admindashboard');
})->name('pages.admin.admindashboard');

Route::resource('buses', BusController::class);
Route::resource('locations', LocationController::class);

Route::get('/locations/get', [RouteController::class, 'getLocationss'])->name('locations.get');
Route::resource('routes', RouteController::class);

// ------------------------for bus schedule----------------------------------------
Route::resource('schedules', ScheduleController::class);
Route::get('/get-route-info', [ScheduleController::class, 'getRouteInfo'])->name('get.route.info');
Route::get('/get-coaches', [ScheduleController::class, 'getCoachesByBusType'])->name('get.coaches');

// ------------------------for search chedule bus ----------------------------------------
Route::get('/locations/search', [SearchScheduleBusController::class, 'getLocations'])->name('locations.get');
Route::get('/', [SearchScheduleBusController::class, 'index'])->name('bus.search.form');
Route::post('/find-bus', [SearchScheduleBusController::class, 'search'])->name('bus.search');


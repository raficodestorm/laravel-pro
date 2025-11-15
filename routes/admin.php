<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\admin\BustypeController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\User\SeatReservationController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
  Route::get('users/create', [UserManagementController::class, 'create'])->name('users.create');
  Route::post('users', [UserManagementController::class, 'store'])->name('users.store');
  Route::get('users/show/{user}', [UserManagementController::class, 'show'])->name('users.show');
  Route::get('users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
  Route::put('users/{user}', [UserManagementController::class, 'update'])->name('users.update');
  Route::delete('users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

  Route::get('/admins', [UserManagementController::class, 'admins'])->name('index.admins');
  Route::get('/controllers', [UserManagementController::class, 'controllers'])->name('index.controllers');
  Route::get('/counter-managers', [UserManagementController::class, 'counterManagers'])->name('index.counterManagers');
  Route::get('/normal-users', [UserManagementController::class, 'normalUsers'])->name('index.normalUsers');

  Route::resource('bustypes', BustypeController::class);
  Route::resource('buses', BusController::class);
  Route::resource('drivers', DriverController::class);
  Route::resource('supervisors', SupervisorController::class);
  Route::resource('locations', LocationController::class);
  Route::resource('routes', RouteController::class);
  Route::resource('counters', CounterController::class);
  Route::resource('costs', CostController::class);
  Route::resource('schedules', ScheduleController::class);
  Route::patch('/schedules/{schedule}/start', [ScheduleController::class, 'start'])->name('schedules.start');
  Route::patch('/schedules/{schedule}/finish', [ScheduleController::class, 'finish'])->name('schedules.finish');
  Route::patch('/schedules/{schedule}/pending', [ScheduleController::class, 'pending'])->name('schedules.pending');
  Route::get('/schedules/{schedule}/report', [ScheduleController::class, 'tripReport'])->name('schedules.report');


  Route::get('/get-route-info', [ScheduleController::class, 'getRouteInfo'])->name('get.route.info');
  Route::get('/get-coaches', [ScheduleController::class, 'getCoachesByBusType'])->name('get.coaches');


  Route::get('trip/pending', [TripController::class, 'pendingtrip'])->name('pendingtrip');
  Route::get('trip/running', [TripController::class, 'runningtrip'])->name('runningtrip');
  Route::get('trip/finished', [TripController::class, 'finishedtrip'])->name('finishedtrip');
  Route::get('trip/{schedule}/manage', [TripController::class, 'manage'])->name('tripmanage');
  Route::delete('trip/{schedule}/delete', [ScheduleController::class, 'destroytrip'])->name('tripdelete');
  Route::patch('/admin/schedules/{id}/update-driver', [ScheduleController::class, 'updateDriver'])->name('schedules.updateDriver');
  Route::patch('/admin/schedules/{id}/update-supervisor', [ScheduleController::class, 'updateSupervisor'])->name('schedules.updateSupervisor');


  Route::get('/reservation/{id}/edit', [SeatReservationController::class, 'edit'])->name('reservation.edit');
  Route::put('/reservation/{id}', [SeatReservationController::class, 'update'])->name('reservation.update');

  Route::get('/reservation/index', [SeatReservationController::class, 'index'])->name('reservation.index');
  Route::delete('/reservation/{seatReservation}', [SeatReservationController::class, 'destroy'])->name('reservation.delete');
});

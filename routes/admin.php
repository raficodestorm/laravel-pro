<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\admin\BustypeController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserManagementController;
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
  Route::resource('locations', LocationController::class);
  Route::resource('routes', RouteController::class);
  Route::resource('schedules', ScheduleController::class);
  Route::resource('counters', CounterController::class);

  Route::get('/get-route-info', [ScheduleController::class, 'getRouteInfo'])->name('get.route.info');
  Route::get('/get-coaches', [ScheduleController::class, 'getCoachesByBusType'])->name('get.coaches');

  Route::get('/reservation/{id}/edit', [SeatReservationController::class, 'edit'])->name('reservation.edit');
  Route::put('/reservation/{id}', [SeatReservationController::class, 'update'])->name('reservation.update');
});

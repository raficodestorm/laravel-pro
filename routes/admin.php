<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\UserManagementController;


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
  Route::get('users/create', [UserManagementController::class, 'create'])->name('users.create');
  Route::post('users', [UserManagementController::class, 'store'])->name('users.store');
  Route::get('users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
  Route::put('users/{user}', [UserManagementController::class, 'update'])->name('users.update');
  Route::delete('users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

  Route::get('/admins', [UserManagementController::class, 'admins'])->name('index.admins');
  Route::get('/controllers', [UserManagementController::class, 'controllers'])->name('index.controllers');
  Route::get('/counter-managers', [UserManagementController::class, 'counterManagers'])->name('index.counterManagers');
  Route::get('/normal-users', [UserManagementController::class, 'normalUsers'])->name('index.normalUsers');

  Route::resource('buses', BusController::class);
  Route::resource('locations', LocationController::class);
  Route::resource('routes', RouteController::class);

  Route::resource('schedules', ScheduleController::class);
  Route::get('/get-route-info', [ScheduleController::class, 'getRouteInfo'])->name('get.route.info');
  Route::get('/get-coaches', [ScheduleController::class, 'getCoachesByBusType'])->name('get.coaches');
});

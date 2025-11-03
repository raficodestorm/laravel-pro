<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// dashboards (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user', function () {
        return view('dashboards.user');
    })->name('dashboard.user')->middleware('role:user,admin,counter_manager'); // user page - accessible by user (admin can also view if needed)

    Route::get('/dashboard/manager', function () {
        return view('dashboards.manager');
    })->name('dashboard.manager')->middleware('role:counter_manager');

    Route::get('/dashboard/admin', function () {
        return view('dashboards.admin');
    })->name('dashboard.admin')->middleware('role:admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update Profile Information
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete Account (optional, if you want to keep Breeze's delete)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/manager.php';
require __DIR__ . '/controller.php';

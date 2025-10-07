<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.user.userfront');
})->name('user-main-page');

Route::get('/page-second', function () {
    return view('page-2');
})->name('page-2');

Route::get('/page-third', function () {
    return view('page-3');
})->name('page-3');

Route::get('/Admin-Dashboard', function () {
    return view('pages/admin/admindashboard');
});

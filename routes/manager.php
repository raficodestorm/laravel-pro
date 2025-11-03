<?php

use Illuminate\Support\Facades\Route;


Route::prefix('manager')->name('manager.')->middleware(['auth', 'role:manager'])->group(function () {});

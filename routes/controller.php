<?php

use Illuminate\Support\Facades\Route;


Route::prefix('controller')->name('controller.')->middleware(['auth', 'role:controller'])->group(function () {});

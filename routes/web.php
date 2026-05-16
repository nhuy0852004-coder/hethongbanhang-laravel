<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quantri\BangdieukhienController;
use App\Http\Controllers\Website\TrangchuController;

Route::get('/', [TrangchuController::class, 'index'])->name('trangchu');

Route::prefix('quantri')
    ->name('quantri.')
    ->group(function () {
        Route::get('/', [BangdieukhienController::class, 'index'])->name('bangdieukhien');
    });
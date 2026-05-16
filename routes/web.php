<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quantri\BangdieukhienController;
use App\Http\Controllers\Website\TrangchuController;
use App\Http\Controllers\Xacthuc\DangnhapController;

Route::get('/', [TrangchuController::class, 'index'])->name('trangchu');

Route::middleware('guest')->group(function () {
    Route::get('/dang-nhap', [DangnhapController::class, 'index'])->name('dangnhap');
    Route::post('/dang-nhap', [DangnhapController::class, 'xuly'])->name('dangnhap.xuly');
});

Route::post('/dang-xuat', [DangnhapController::class, 'dangxuat'])->name('dangxuat');

Route::prefix('quantri')
    ->name('quantri.')
    ->middleware(['kiemtraquantri'])
    ->group(function () {
        Route::get('/', [BangdieukhienController::class, 'index'])->name('bangdieukhien');
    });
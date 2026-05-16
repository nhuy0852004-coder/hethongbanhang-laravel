<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quantri\BangdieukhienController;
use App\Http\Controllers\Quantri\DanhmucController;
use App\Http\Controllers\Quantri\SanphamController;
use App\Http\Controllers\Xacthuc\DangnhapController;
use App\Http\Controllers\Cuahang\TrangchuController as CuahangTrangchuController;
use App\Http\Controllers\Cuahang\SanphamController as CuahangSanphamController;

Route::get('/', [CuahangTrangchuController::class, 'index'])->name('trangchu');

Route::get('/san-pham', [CuahangSanphamController::class, 'index'])
    ->name('cuahang.sanpham.index');

Route::get('/san-pham/{duongDan}', [CuahangSanphamController::class, 'show'])
    ->name('cuahang.sanpham.show');

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

        Route::resource('danhmuc', DanhmucController::class);
        Route::patch('danhmuc/{danhmuc}/doi-trang-thai', [DanhmucController::class, 'doiTrangThai'])
            ->name('danhmuc.doi-trang-thai');

        Route::resource('sanpham', SanphamController::class)->only([
            'index',
            'store',
            'update',
            'destroy',
        ]);
        Route::patch('sanpham/{sanpham}/doi-trang-thai', [SanphamController::class, 'doiTrangThai'])
            ->name('sanpham.doi-trang-thai');
    });
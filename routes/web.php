<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quantri\BangdieukhienController;
use App\Http\Controllers\Quantri\DanhmucController;
use App\Http\Controllers\Quantri\SanphamController;
use App\Http\Controllers\Quantri\DonhangController;
use App\Http\Controllers\Quantri\ThongbaoController;
use App\Http\Controllers\Xacthuc\DangnhapController;
use App\Http\Controllers\Cuahang\TrangchuController as CuahangTrangchuController;
use App\Http\Controllers\Cuahang\SanphamController as CuahangSanphamController;
use App\Http\Controllers\Cuahang\GiohangController;
use App\Http\Controllers\Cuahang\ThanhtoanController;

Route::get('/', [CuahangTrangchuController::class, 'index'])->name('trangchu');

Route::get('/san-pham', [CuahangSanphamController::class, 'index'])
    ->name('cuahang.sanpham.index');

Route::get('/san-pham/{duongDan}', [CuahangSanphamController::class, 'show'])
    ->name('cuahang.sanpham.show');

Route::get('/gio-hang', [GiohangController::class, 'index'])
    ->name('cuahang.giohang.index');

Route::post('/gio-hang/them/{sanpham}', [GiohangController::class, 'them'])
    ->name('cuahang.giohang.them');

Route::patch('/gio-hang/cap-nhat', [GiohangController::class, 'capnhat'])
    ->name('cuahang.giohang.capnhat');

Route::delete('/gio-hang/xoa/{sanphamId}', [GiohangController::class, 'xoa'])
    ->name('cuahang.giohang.xoa');

Route::delete('/gio-hang/xoa-tat-ca', [GiohangController::class, 'xoatatca'])
    ->name('cuahang.giohang.xoatatca');

Route::get('/thanh-toan', [ThanhtoanController::class, 'index'])
    ->name('cuahang.thanhtoan.index');

Route::post('/thanh-toan/dat-hang', [ThanhtoanController::class, 'dathang'])
    ->name('cuahang.thanhtoan.dathang');

Route::get('/thanh-toan/thanh-cong/{maDonHang}', [ThanhtoanController::class, 'thanhcong'])
    ->name('cuahang.thanhtoan.thanhcong');

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

        Route::resource('donhang', DonhangController::class)->only([
            'index',
            'show',
            'update',
        ]);

        Route::get('thongbao', [ThongbaoController::class, 'index'])
            ->name('thongbao.index');

        Route::patch('thongbao/danh-dau-tat-ca-da-doc', [ThongbaoController::class, 'danhDauTatCaDaDoc'])
            ->name('thongbao.danh-dau-tat-ca-da-doc');

        Route::patch('thongbao/{thongbao}/danh-dau-da-doc', [ThongbaoController::class, 'danhDauDaDoc'])
            ->name('thongbao.danh-dau-da-doc');
    });
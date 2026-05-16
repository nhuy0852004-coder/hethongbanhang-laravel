<?php

namespace App\Repositories;

use App\Models\Chitietdonhang;
use App\Models\Donhang;
use App\Models\Khachhang;
use Illuminate\Support\Facades\Schema;

class DonhangRepository
{
    public function taoHoacCapNhatKhachhang(array $duLieu): Khachhang
    {
        $thongTin = [
            'ho_ten' => $duLieu['ho_ten_nguoi_nhan'],
            'email' => $duLieu['email'] ?? null,
            'dia_chi' => $duLieu['dia_chi'],
        ];

        if (Schema::hasColumn('khachhang', 'tinh_thanh')) {
            $thongTin['tinh_thanh'] = $duLieu['tinh_thanh'] ?? null;
        }

        if (Schema::hasColumn('khachhang', 'quan_huyen')) {
            $thongTin['quan_huyen'] = $duLieu['quan_huyen'] ?? null;
        }

        if (Schema::hasColumn('khachhang', 'phuong_xa')) {
            $thongTin['phuong_xa'] = $duLieu['phuong_xa'] ?? null;
        }

        return Khachhang::updateOrCreate(
            [
                'so_dien_thoai' => $duLieu['so_dien_thoai'],
            ],
            $thongTin
        );
    }

    public function taoDonhang(array $duLieu): Donhang
    {
        return Donhang::create($duLieu);
    }

    public function taoChitietDonhang(array $duLieu): Chitietdonhang
    {
        return Chitietdonhang::create($duLieu);
    }

    public function tonTaiMaDonHang(string $maDonHang): bool
    {
        return Donhang::query()
            ->where('ma_don_hang', $maDonHang)
            ->exists();
    }

    public function layTheoMaDonHang(string $maDonHang): Donhang
    {
        return Donhang::query()
            ->with('chitietdonhang')
            ->where('ma_don_hang', $maDonHang)
            ->firstOrFail();
    }
}

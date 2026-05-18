<?php

namespace App\Repositories;

use App\Models\Chitietdonhang;
use App\Models\Donhang;
use App\Models\Khachhang;

class DonhangRepository
{
    public function layDanhSach(array $boLoc)
    {
        return Donhang::query()
            ->with('khachhang')
            ->when(!empty($boLoc['tu_khoa']), function ($query) use ($boLoc) {
                $query->where(function ($truyVan) use ($boLoc) {
                    $truyVan->where('ma_don_hang', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('ho_ten_nguoi_nhan', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('so_dien_thoai', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('email', 'like', '%' . $boLoc['tu_khoa'] . '%');
                });
            })
            ->when(!empty($boLoc['trang_thai']), function ($query) use ($boLoc) {
                $query->where('trang_thai', $boLoc['trang_thai']);
            })
            ->when(!empty($boLoc['tu_ngay']), function ($query) use ($boLoc) {
                $query->whereDate('created_at', '>=', $boLoc['tu_ngay']);
            })
            ->when(!empty($boLoc['den_ngay']), function ($query) use ($boLoc) {
                $query->whereDate('created_at', '<=', $boLoc['den_ngay']);
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }

    public function taoHoacCapNhatKhachhang(array $duLieu): Khachhang
    {
        return Khachhang::updateOrCreate(
            [
                'so_dien_thoai' => $duLieu['so_dien_thoai'],
            ],
            [
                'ho_ten' => $duLieu['ho_ten_nguoi_nhan'],
                'email' => $duLieu['email'] ?? null,
                'dia_chi' => $duLieu['dia_chi'],
                'tinh_thanh' => $duLieu['tinh_thanh'] ?? null,
                'quan_huyen' => $duLieu['quan_huyen'] ?? null,
                'phuong_xa' => $duLieu['phuong_xa'] ?? null,
            ]
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

    public function capnhat(Donhang $donhang, array $duLieu): bool
    {
        return $donhang->update($duLieu);
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

    public function layTheoMaVaSoDienThoai(string $maDonHang, string $soDienThoai): ?Donhang
    {
        return Donhang::query()
            ->with('chitietdonhang')
            ->where('ma_don_hang', $maDonHang)
            ->where('so_dien_thoai', $soDienThoai)
            ->first();
    }

    public function layChiTietTheoMa(string $maDonHang): Donhang
    {
        return Donhang::query()
            ->with('chitietdonhang')
            ->where('ma_don_hang', $maDonHang)
            ->firstOrFail();
    }
}

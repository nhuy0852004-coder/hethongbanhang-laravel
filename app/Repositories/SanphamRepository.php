<?php

namespace App\Repositories;

use App\Models\Sanpham;

class SanphamRepository
{
    public function layDanhSach(array $boLoc)
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->when(!empty($boLoc['tu_khoa']), function ($query) use ($boLoc) {
                $query->where(function ($truyVan) use ($boLoc) {
                    $truyVan->where('ten_san_pham', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('ma_san_pham', 'like', '%' . $boLoc['tu_khoa'] . '%');
                });
            })
            ->when(!empty($boLoc['danhmuc_id']), function ($query) use ($boLoc) {
                $query->where('danhmuc_id', $boLoc['danhmuc_id']);
            })
            ->when(!empty($boLoc['trang_thai']), function ($query) use ($boLoc) {
                $query->where('trang_thai', $boLoc['trang_thai']);
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();
    }

    public function tao(array $duLieu): Sanpham
    {
        return Sanpham::create($duLieu);
    }

    public function tonTaiDuongDan(string $duongDan): bool
    {
        return Sanpham::query()
            ->where('duong_dan', $duongDan)
            ->exists();
    }

    public function tonTaiMaSanPham(string $maSanPham): bool
    {
        return Sanpham::query()
            ->where('ma_san_pham', $maSanPham)
            ->exists();
    }
}
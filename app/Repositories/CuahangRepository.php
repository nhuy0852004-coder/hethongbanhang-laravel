<?php

namespace App\Repositories;

use App\Models\Danhmuc;
use App\Models\Sanpham;

class CuahangRepository
{
    public function layDanhmucNoiBat()
    {
        return Danhmuc::query()
            ->where('trang_thai', 'hoat_dong')
            ->withCount(['sanpham' => function ($query) {
                $query->where('trang_thai', 'hien_thi');
            }])
            ->orderBy('thu_tu')
            ->orderByDesc('sanpham_count')
            ->limit(6)
            ->get();
    }

    public function laySanphamMoi()
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('trang_thai', 'hien_thi')
            ->where('so_luong_ton', '>', 0)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

    public function laySanphamKhuyenMai()
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('trang_thai', 'hien_thi')
            ->where('so_luong_ton', '>', 0)
            ->whereNotNull('gia_khuyen_mai')
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

    public function layDanhSachSanpham(array $boLoc)
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('trang_thai', 'hien_thi')
            ->when(!empty($boLoc['tu_khoa']), function ($query) use ($boLoc) {
                $query->where(function ($truyVan) use ($boLoc) {
                    $truyVan->where('ten_san_pham', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('mo_ta_ngan', 'like', '%' . $boLoc['tu_khoa'] . '%');
                });
            })
            ->when(!empty($boLoc['danhmuc']), function ($query) use ($boLoc) {
                $query->whereHas('danhmuc', function ($truyVan) use ($boLoc) {
                    $truyVan->where('duong_dan', $boLoc['danhmuc']);
                });
            })
            ->when(!empty($boLoc['gia_tu']), function ($query) use ($boLoc) {
                $query->whereRaw('COALESCE(gia_khuyen_mai, gia_ban) >= ?', [$boLoc['gia_tu']]);
            })
            ->when(!empty($boLoc['gia_den']), function ($query) use ($boLoc) {
                $query->whereRaw('COALESCE(gia_khuyen_mai, gia_ban) <= ?', [$boLoc['gia_den']]);
            })
            ->when(($boLoc['sap_xep'] ?? '') === 'gia_thap', function ($query) {
                $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_ban) ASC');
            })
            ->when(($boLoc['sap_xep'] ?? '') === 'gia_cao', function ($query) {
                $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_ban) DESC');
            })
            ->when(($boLoc['sap_xep'] ?? '') === 'moi_nhat' || empty($boLoc['sap_xep']), function ($query) {
                $query->orderByDesc('id');
            })
            ->paginate(12)
            ->withQueryString();
    }

    public function layDanhmucHoatDong()
    {
        return Danhmuc::query()
            ->where('trang_thai', 'hoat_dong')
            ->withCount(['sanpham' => function ($query) {
                $query->where('trang_thai', 'hien_thi');
            }])
            ->orderBy('thu_tu')
            ->orderBy('ten_danh_muc')
            ->get();
    }

    public function laySanphamTheoDuongDan(string $duongDan)
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('duong_dan', $duongDan)
            ->where('trang_thai', 'hien_thi')
            ->firstOrFail();
    }

    public function laySanphamLienQuan(Sanpham $sanpham)
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('id', '!=', $sanpham->id)
            ->where('danhmuc_id', $sanpham->danhmuc_id)
            ->where('trang_thai', 'hien_thi')
            ->where('so_luong_ton', '>', 0)
            ->orderByDesc('id')
            ->limit(4)
            ->get();
    }
}
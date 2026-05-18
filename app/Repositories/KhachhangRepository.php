<?php

namespace App\Repositories;

use App\Models\Donhang;
use App\Models\Khachhang;

class KhachhangRepository
{
    public function layDanhSach(array $boLoc)
    {
        return Khachhang::query()
            ->withCount('donhang')
            ->withSum([
                'donhang as tong_chi_tieu' => function ($query) {
                    $query->where('trang_thai', 'hoan_thanh');
                }
            ], 'tong_thanh_toan')
            ->when(!empty($boLoc['tu_khoa']), function ($query) use ($boLoc) {
                $query->where(function ($truyVan) use ($boLoc) {
                    $truyVan->where('ho_ten', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('so_dien_thoai', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('email', 'like', '%' . $boLoc['tu_khoa'] . '%');
                });
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }

    public function thongKeKhachhang(Khachhang $khachhang): array
    {
        $query = Donhang::query()
            ->where('khachhang_id', $khachhang->id);

        return [
            'tong_don_hang' => (clone $query)->count(),

            'tong_don_hoan_thanh' => (clone $query)
                ->where('trang_thai', 'hoan_thanh')
                ->count(),

            'tong_don_da_huy' => (clone $query)
                ->where('trang_thai', 'da_huy')
                ->count(),

            'tong_chi_tieu' => (int) (clone $query)
                ->where('trang_thai', 'hoan_thanh')
                ->sum('tong_thanh_toan'),

            'don_gan_nhat' => (clone $query)
                ->orderByDesc('id')
                ->first(),
        ];
    }

    public function layLichSuDonHang(Khachhang $khachhang)
    {
        return Donhang::query()
            ->withCount('chitietdonhang')
            ->where('khachhang_id', $khachhang->id)
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();
    }
}

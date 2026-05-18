<?php

namespace App\Repositories;

use App\Models\Chitietdonhang;
use App\Models\Donhang;
use App\Models\Khachhang;
use App\Models\Sanpham;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BaocaoRepository
{
    public function tongDoanhThuHomNay(): int
    {
        return (int) Donhang::query()
            ->whereDate('created_at', today())
            ->where('trang_thai', 'hoan_thanh')
            ->sum('tong_thanh_toan');
    }

    public function tongDonHangHomNay(): int
    {
        return Donhang::query()
            ->whereDate('created_at', today())
            ->count();
    }

    public function tongSanPham(): int
    {
        return Sanpham::query()->count();
    }

    public function tongKhachHang(): int
    {
        return Khachhang::query()->count();
    }

    public function doanhThu7Ngay(): array
    {
        $ngayBatDau = now()->subDays(6)->startOfDay();
        $ngayKetThuc = now()->endOfDay();

        $duLieu = Donhang::query()
            ->selectRaw('DATE(created_at) as ngay, SUM(tong_thanh_toan) as doanh_thu')
            ->where('trang_thai', 'hoan_thanh')
            ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
            ->groupByRaw('DATE(created_at)')
            ->pluck('doanh_thu', 'ngay')
            ->toArray();

        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $ngay = now()->subDays($i);
            $key = $ngay->format('Y-m-d');

            $labels[] = $ngay->format('d/m');
            $values[] = (int) ($duLieu[$key] ?? 0);
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function donHangMoiNhat(int $soLuong = 6)
    {
        return Donhang::query()
            ->orderByDesc('id')
            ->limit($soLuong)
            ->get();
    }

    public function sanPhamSapHetHang(int $soLuong = 8)
    {
        return Sanpham::query()
            ->with('danhmuc')
            ->where('so_luong_ton', '<=', 5)
            ->orderBy('so_luong_ton')
            ->orderByDesc('id')
            ->limit($soLuong)
            ->get();
    }

    public function thongKeDoanhThuTheoKhoangNgay(?string $tuNgay, ?string $denNgay): array
    {
        $tuNgay = $tuNgay ?: now()->startOfMonth()->format('Y-m-d');
        $denNgay = $denNgay ?: now()->format('Y-m-d');

        $query = Donhang::query()
            ->whereBetween(DB::raw('DATE(created_at)'), [$tuNgay, $denNgay]);

        $tongDoanhThu = (clone $query)
            ->where('trang_thai', 'hoan_thanh')
            ->sum('tong_thanh_toan');

        $tongDonHoanThanh = (clone $query)
            ->where('trang_thai', 'hoan_thanh')
            ->count();

        $tongDonDaHuy = (clone $query)
            ->where('trang_thai', 'da_huy')
            ->count();

        $tongDonMoi = (clone $query)->count();

        return [
            'tu_ngay' => $tuNgay,
            'den_ngay' => $denNgay,
            'tong_doanh_thu' => (int) $tongDoanhThu,
            'tong_don_moi' => $tongDonMoi,
            'tong_don_hoan_thanh' => $tongDonHoanThanh,
            'tong_don_da_huy' => $tongDonDaHuy,
        ];
    }

    public function doanhThuTheoNgay(?string $tuNgay, ?string $denNgay): array
    {
        $tuNgay = $tuNgay ?: now()->startOfMonth()->format('Y-m-d');
        $denNgay = $denNgay ?: now()->format('Y-m-d');

        $duLieu = Donhang::query()
            ->selectRaw('DATE(created_at) as ngay, SUM(tong_thanh_toan) as doanh_thu')
            ->where('trang_thai', 'hoan_thanh')
            ->whereBetween(DB::raw('DATE(created_at)'), [$tuNgay, $denNgay])
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->pluck('doanh_thu', 'ngay')
            ->toArray();

        $labels = [];
        $values = [];

        $batDau = Carbon::parse($tuNgay);
        $ketThuc = Carbon::parse($denNgay);

        while ($batDau->lte($ketThuc)) {
            $key = $batDau->format('Y-m-d');

            $labels[] = $batDau->format('d/m');
            $values[] = (int) ($duLieu[$key] ?? 0);

            $batDau->addDay();
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function topSanPhamBanChay(?string $tuNgay, ?string $denNgay, int $soLuong = 10)
    {
        $tuNgay = $tuNgay ?: now()->startOfMonth()->format('Y-m-d');
        $denNgay = $denNgay ?: now()->format('Y-m-d');

        return Chitietdonhang::query()
            ->select([
                'ten_san_pham',
                DB::raw('SUM(so_luong) as tong_so_luong'),
                DB::raw('SUM(thanh_tien) as tong_doanh_thu'),
            ])
            ->whereHas('donhang', function ($query) use ($tuNgay, $denNgay) {
                $query->where('trang_thai', 'hoan_thanh')
                    ->whereBetween(DB::raw('DATE(created_at)'), [$tuNgay, $denNgay]);
            })
            ->groupBy('ten_san_pham')
            ->orderByDesc('tong_so_luong')
            ->limit($soLuong)
            ->get();
    }
}

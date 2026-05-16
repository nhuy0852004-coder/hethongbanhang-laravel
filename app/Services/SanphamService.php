<?php

namespace App\Services;

use App\Models\Sanpham;
use App\Repositories\SanphamRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SanphamService
{
    public function __construct(
        protected SanphamRepository $sanphamRepository
    ) {
    }

    public function layDanhSach(array $boLoc)
    {
        return $this->sanphamRepository->layDanhSach($boLoc);
    }

    public function tao(array $duLieu): Sanpham
    {
        return DB::transaction(function () use ($duLieu) {
            if (empty($duLieu['ma_san_pham'])) {
                $duLieu['ma_san_pham'] = $this->taoMaSanPham();
            }

            $duLieu['duong_dan'] = $this->taoDuongDanDuyNhat($duLieu['ten_san_pham']);

            if (isset($duLieu['anh_dai_dien'])) {
                $duLieu['anh_dai_dien'] = $duLieu['anh_dai_dien']->store('sanpham', 'public');
            }

            if ((int) $duLieu['so_luong_ton'] === 0) {
                $duLieu['trang_thai'] = 'het_hang';
            }

            return $this->sanphamRepository->tao($duLieu);
        });
    }

    protected function taoDuongDanDuyNhat(string $tenSanPham): string
    {
        $duongDanGoc = Str::slug($tenSanPham);
        $duongDan = $duongDanGoc;
        $soThuTu = 1;

        while ($this->sanphamRepository->tonTaiDuongDan($duongDan)) {
            $duongDan = $duongDanGoc . '-' . $soThuTu;
            $soThuTu++;
        }

        return $duongDan;
    }

    protected function taoMaSanPham(): string
    {
        do {
            $maSanPham = 'SP' . now()->format('ymd') . random_int(1000, 9999);
        } while ($this->sanphamRepository->tonTaiMaSanPham($maSanPham));

        return $maSanPham;
    }
}
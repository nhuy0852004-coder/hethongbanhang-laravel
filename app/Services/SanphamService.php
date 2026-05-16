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

    public function capnhat(Sanpham $sanpham, array $duLieu): bool
    {
        return DB::transaction(function () use ($sanpham, $duLieu) {
            if (empty($duLieu['ma_san_pham'])) {
                $duLieu['ma_san_pham'] = $sanpham->ma_san_pham;
            }

            $duLieu['duong_dan'] = $this->taoDuongDanDuyNhat(
                $duLieu['ten_san_pham'],
                $sanpham->id
            );

            if (isset($duLieu['anh_dai_dien'])) {
                if ($sanpham->anh_dai_dien && Storage::disk('public')->exists($sanpham->anh_dai_dien)) {
                    Storage::disk('public')->delete($sanpham->anh_dai_dien);
                }

                $duLieu['anh_dai_dien'] = $duLieu['anh_dai_dien']->store('sanpham', 'public');
            }

            if ((int) $duLieu['so_luong_ton'] === 0) {
                $duLieu['trang_thai'] = 'het_hang';
            }

            return $this->sanphamRepository->capnhat($sanpham, $duLieu);
        });
    }

    public function xoa(Sanpham $sanpham): bool
    {
        return DB::transaction(function () use ($sanpham) {
            if ($sanpham->anh_dai_dien && Storage::disk('public')->exists($sanpham->anh_dai_dien)) {
                Storage::disk('public')->delete($sanpham->anh_dai_dien);
            }

            return $this->sanphamRepository->xoa($sanpham);
        });
    }

    public function doiTrangThai(Sanpham $sanpham): bool
    {
        if ($sanpham->so_luong_ton <= 0) {
            return $this->sanphamRepository->capnhat($sanpham, [
                'trang_thai' => 'het_hang',
            ]);
        }

        $trangThaiMoi = $sanpham->trang_thai === 'hien_thi' ? 'an' : 'hien_thi';

        return $this->sanphamRepository->capnhat($sanpham, [
            'trang_thai' => $trangThaiMoi,
        ]);
    }

    protected function taoDuongDanDuyNhat(string $tenSanPham, ?int $boQuaId = null): string
    {
        $duongDanGoc = Str::slug($tenSanPham);
        $duongDan = $duongDanGoc;
        $soThuTu = 1;

        while ($this->sanphamRepository->tonTaiDuongDan($duongDan, $boQuaId)) {
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
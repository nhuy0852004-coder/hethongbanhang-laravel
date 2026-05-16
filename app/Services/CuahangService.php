<?php

namespace App\Services;

use App\Models\Sanpham;
use App\Repositories\CuahangRepository;

class CuahangService
{
    public function __construct(
        protected CuahangRepository $cuahangRepository
    ) {
    }

    public function duLieuTrangChu(): array
    {
        return [
            'danhsachDanhmucNoiBat' => $this->cuahangRepository->layDanhmucNoiBat(),
            'danhsachSanphamMoi' => $this->cuahangRepository->laySanphamMoi(),
            'danhsachSanphamKhuyenMai' => $this->cuahangRepository->laySanphamKhuyenMai(),
        ];
    }

    public function duLieuDanhSachSanpham(array $boLoc): array
    {
        return [
            'boLoc' => $boLoc,
            'danhsachDanhmuc' => $this->cuahangRepository->layDanhmucHoatDong(),
            'danhsachSanpham' => $this->cuahangRepository->layDanhSachSanpham($boLoc),
        ];
    }

    public function duLieuChiTietSanpham(string $duongDan): array
    {
        $sanpham = $this->cuahangRepository->laySanphamTheoDuongDan($duongDan);

        return [
            'sanpham' => $sanpham,
            'danhsachSanphamLienQuan' => $this->cuahangRepository->laySanphamLienQuan($sanpham),
        ];
    }

    public function giaHienThi(Sanpham $sanpham): int
    {
        return $sanpham->gia_khuyen_mai ?: $sanpham->gia_ban;
    }
}
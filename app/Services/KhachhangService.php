<?php

namespace App\Services;

use App\Models\Khachhang;
use App\Repositories\KhachhangRepository;

class KhachhangService
{
    public function __construct(
        protected KhachhangRepository $khachhangRepository
    ) {
    }

    public function layDanhSach(array $boLoc)
    {
        return $this->khachhangRepository->layDanhSach($boLoc);
    }

    public function duLieuChiTiet(Khachhang $khachhang): array
    {
        $lichSuDonHang = $this->khachhangRepository->layLichSuDonHang($khachhang);

        return [
            'khachhang' => $khachhang,
            'thongKe' => $this->khachhangRepository->thongKeKhachhang($khachhang),
            'lichSuDonHang' => $lichSuDonHang,
            'danhsachDonhang' => $lichSuDonHang,
        ];
    }
}

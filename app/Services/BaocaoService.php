<?php

namespace App\Services;

use App\Repositories\BaocaoRepository;

class BaocaoService
{
    public function __construct(
        protected BaocaoRepository $baocaoRepository
    ) {
    }

    public function duLieuBangDieuKhien(): array
    {
        return [
            'tongDoanhThuHomNay' => $this->baocaoRepository->tongDoanhThuHomNay(),
            'tongDonHangHomNay' => $this->baocaoRepository->tongDonHangHomNay(),
            'tongSanPham' => $this->baocaoRepository->tongSanPham(),
            'tongKhachHang' => $this->baocaoRepository->tongKhachHang(),
            'bieuDoDoanhThu7Ngay' => $this->baocaoRepository->doanhThu7Ngay(),
            'danhsachDonhangMoiNhat' => $this->baocaoRepository->donHangMoiNhat(),
            'danhsachSanphamSapHetHang' => $this->baocaoRepository->sanPhamSapHetHang(),
        ];
    }

    public function duLieuBaoCaoDoanhThu(?string $tuNgay, ?string $denNgay): array
    {
        $thongKe = $this->baocaoRepository->thongKeDoanhThuTheoKhoangNgay($tuNgay, $denNgay);

        return [
            'boLoc' => [
                'tu_ngay' => $thongKe['tu_ngay'],
                'den_ngay' => $thongKe['den_ngay'],
            ],
            'thongKe' => $thongKe,
            'bieuDoDoanhThu' => $this->baocaoRepository->doanhThuTheoNgay(
                $thongKe['tu_ngay'],
                $thongKe['den_ngay']
            ),
            'danhsachTopSanpham' => $this->baocaoRepository->topSanPhamBanChay(
                $thongKe['tu_ngay'],
                $thongKe['den_ngay']
            ),
        ];
    }
}

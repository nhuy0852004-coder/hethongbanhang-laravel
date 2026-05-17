<?php

namespace App\Services;

use App\Models\Donhang;
use App\Models\Sanpham;
use App\Repositories\DonhangRepository;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DonhangService
{
    public function __construct(
        protected DonhangRepository $donhangRepository,
        protected ThongbaoService $thongbaoService
    ) {
    }

    public function layDanhSach(array $boLoc)
    {
        return $this->donhangRepository->layDanhSach($boLoc);
    }

    public function taoTuGioHang(array $duLieu, GiohangService $giohangService): Donhang
    {
        $gioHang = $giohangService->layDanhSach();

        if (count($gioHang) === 0) {
            throw new RuntimeException('Giỏ hàng đang trống.');
        }

        $donhang = DB::transaction(function () use ($duLieu, $gioHang) {
            $tongTienHang = 0;
            $danhsachChitiet = [];

            foreach ($gioHang as $item) {
                $sanpham = Sanpham::query()
                    ->where('id', $item['sanpham_id'])
                    ->lockForUpdate()
                    ->first();

                if (! $sanpham) {
                    throw new RuntimeException('Một sản phẩm trong giỏ hàng không còn tồn tại.');
                }

                if ($sanpham->trang_thai !== 'hien_thi') {
                    throw new RuntimeException('Sản phẩm "' . $sanpham->ten_san_pham . '" hiện không còn được bán.');
                }

                if ($item['so_luong'] > $sanpham->so_luong_ton) {
                    throw new RuntimeException('Sản phẩm "' . $sanpham->ten_san_pham . '" không đủ số lượng tồn kho.');
                }

                $giaHienTai = $sanpham->gia_khuyen_mai ?: $sanpham->gia_ban;
                $thanhTien = $giaHienTai * $item['so_luong'];

                $tongTienHang += $thanhTien;

                $danhsachChitiet[] = [
                    'sanpham' => $sanpham,
                    'ten_san_pham' => $sanpham->ten_san_pham,
                    'anh_san_pham' => $sanpham->anh_dai_dien,
                    'gia_ban' => $giaHienTai,
                    'so_luong' => $item['so_luong'],
                    'thanh_tien' => $thanhTien,
                ];
            }

            $phiVanChuyen = 0;
            $giamGia = 0;
            $tongThanhToan = $tongTienHang + $phiVanChuyen - $giamGia;

            $khachhang = $this->donhangRepository->taoHoacCapNhatKhachhang($duLieu);

            $donhang = $this->donhangRepository->taoDonhang([
                'ma_don_hang' => $this->taoMaDonHang(),
                'khachhang_id' => $khachhang->id,
                'ho_ten_nguoi_nhan' => $duLieu['ho_ten_nguoi_nhan'],
                'so_dien_thoai' => $duLieu['so_dien_thoai'],
                'email' => $duLieu['email'] ?? null,
                'dia_chi' => $duLieu['dia_chi'],
                'tinh_thanh' => $duLieu['tinh_thanh'] ?? null,
                'quan_huyen' => $duLieu['quan_huyen'] ?? null,
                'phuong_xa' => $duLieu['phuong_xa'] ?? null,
                'tong_tien_hang' => $tongTienHang,
                'phi_van_chuyen' => $phiVanChuyen,
                'giam_gia' => $giamGia,
                'tong_thanh_toan' => $tongThanhToan,
                'phuong_thuc_thanh_toan' => $duLieu['phuong_thuc_thanh_toan'],
                'trang_thai' => 'cho_xac_nhan',
                'ghi_chu' => $duLieu['ghi_chu'] ?? null,
            ]);

            foreach ($danhsachChitiet as $chitiet) {
                $sanpham = $chitiet['sanpham'];

                $this->donhangRepository->taoChitietDonhang([
                    'donhang_id' => $donhang->id,
                    'sanpham_id' => $sanpham->id,
                    'ten_san_pham' => $chitiet['ten_san_pham'],
                    'anh_san_pham' => $chitiet['anh_san_pham'],
                    'gia_ban' => $chitiet['gia_ban'],
                    'so_luong' => $chitiet['so_luong'],
                    'thanh_tien' => $chitiet['thanh_tien'],
                ]);

                $sanpham->so_luong_ton -= $chitiet['so_luong'];

                if ($sanpham->so_luong_ton <= 0) {
                    $sanpham->so_luong_ton = 0;
                    $sanpham->trang_thai = 'het_hang';
                }

                $sanpham->save();
            }

            return $donhang;
        });

        $this->thongbaoService->taoThongbaoDonhangMoi($donhang);

        return $donhang;
    }

    public function capnhatTrangThai(Donhang $donhang, string $trangThaiMoi): bool
    {
        return DB::transaction(function () use ($donhang, $trangThaiMoi) {
            if ($donhang->trang_thai === 'hoan_thanh' && $trangThaiMoi === 'da_huy') {
                throw new RuntimeException('Không thể hủy đơn hàng đã hoàn thành.');
            }

            if ($donhang->trang_thai === 'da_huy' && $trangThaiMoi !== 'da_huy') {
                throw new RuntimeException('Không thể khôi phục đơn hàng đã hủy trong phiên bản hiện tại.');
            }

            return $this->donhangRepository->capnhat($donhang, [
                'trang_thai' => $trangThaiMoi,
            ]);
        });
    }

    public function layTheoMaDonHang(string $maDonHang): Donhang
    {
        return $this->donhangRepository->layTheoMaDonHang($maDonHang);
    }

    protected function taoMaDonHang(): string
    {
        do {
            $maDonHang = 'DH' . now()->format('ymdHis') . random_int(100, 999);
        } while ($this->donhangRepository->tonTaiMaDonHang($maDonHang));

        return $maDonHang;
    }
}

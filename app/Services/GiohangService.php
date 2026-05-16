<?php

namespace App\Services;

use App\Models\Sanpham;
use RuntimeException;

class GiohangService
{
    protected string $khoaGioHang = 'giohang';

    public function layDanhSach(): array
    {
        return session()->get($this->khoaGioHang, []);
    }

    public function demSoLuong(): int
    {
        return collect($this->layDanhSach())->sum('so_luong');
    }

    public function tinhTongTien(): int
    {
        return collect($this->layDanhSach())->sum(function ($sanpham) {
            return $sanpham['gia_hien_tai'] * $sanpham['so_luong'];
        });
    }

    public function them(Sanpham $sanpham, int $soLuong = 1): void
    {
        if ($sanpham->trang_thai !== 'hien_thi') {
            throw new RuntimeException('Sản phẩm hiện không khả dụng.');
        }

        if ($sanpham->so_luong_ton <= 0) {
            throw new RuntimeException('Sản phẩm đã hết hàng.');
        }

        $gioHang = $this->layDanhSach();

        $soLuongHienTai = $gioHang[$sanpham->id]['so_luong'] ?? 0;
        $soLuongMoi = $soLuongHienTai + $soLuong;

        if ($soLuongMoi > $sanpham->so_luong_ton) {
            throw new RuntimeException('Số lượng trong giỏ vượt quá tồn kho hiện tại.');
        }

        $gioHang[$sanpham->id] = [
            'sanpham_id' => $sanpham->id,
            'ten_san_pham' => $sanpham->ten_san_pham,
            'duong_dan' => $sanpham->duong_dan,
            'anh_dai_dien' => $sanpham->anh_dai_dien,
            'gia_ban' => $sanpham->gia_ban,
            'gia_khuyen_mai' => $sanpham->gia_khuyen_mai,
            'gia_hien_tai' => $sanpham->gia_khuyen_mai ?: $sanpham->gia_ban,
            'so_luong' => $soLuongMoi,
            'so_luong_ton' => $sanpham->so_luong_ton,
        ];

        session()->put($this->khoaGioHang, $gioHang);
    }

    public function capnhat(array $danhsachSoLuong): void
    {
        $gioHang = $this->layDanhSach();

        foreach ($danhsachSoLuong as $sanphamId => $soLuong) {
            $soLuong = (int) $soLuong;

            if (! isset($gioHang[$sanphamId])) {
                continue;
            }

            if ($soLuong <= 0) {
                unset($gioHang[$sanphamId]);
                continue;
            }

            $sanpham = Sanpham::find($sanphamId);

            if (! $sanpham || $sanpham->trang_thai !== 'hien_thi') {
                unset($gioHang[$sanphamId]);
                continue;
            }

            if ($soLuong > $sanpham->so_luong_ton) {
                throw new RuntimeException('Số lượng sản phẩm "' . $sanpham->ten_san_pham . '" vượt quá tồn kho.');
            }

            $gioHang[$sanphamId]['so_luong'] = $soLuong;
            $gioHang[$sanphamId]['so_luong_ton'] = $sanpham->so_luong_ton;
            $gioHang[$sanphamId]['gia_ban'] = $sanpham->gia_ban;
            $gioHang[$sanphamId]['gia_khuyen_mai'] = $sanpham->gia_khuyen_mai;
            $gioHang[$sanphamId]['gia_hien_tai'] = $sanpham->gia_khuyen_mai ?: $sanpham->gia_ban;
        }

        session()->put($this->khoaGioHang, $gioHang);
    }

    public function xoa(int $sanphamId): void
    {
        $gioHang = $this->layDanhSach();

        unset($gioHang[$sanphamId]);

        session()->put($this->khoaGioHang, $gioHang);
    }

    public function xoatatca(): void
    {
        session()->forget($this->khoaGioHang);
    }

    public function trong(): bool
    {
        return count($this->layDanhSach()) === 0;
    }
}
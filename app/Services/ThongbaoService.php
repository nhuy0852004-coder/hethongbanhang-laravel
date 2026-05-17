<?php

namespace App\Services;

use App\Events\DonhangMoiEvent;
use App\Models\Donhang;
use App\Models\Thongbao;

class ThongbaoService
{
    public function taoThongbaoDonhangMoi(Donhang $donhang): Thongbao
    {
        $thongbao = Thongbao::create([
            'tieu_de' => 'Có đơn hàng mới',
            'noi_dung' => 'Đơn hàng ' . $donhang->ma_don_hang . ' vừa được tạo.',
            'loai' => 'don_hang_moi',
            'du_lieu' => [
                'donhang_id' => $donhang->id,
                'ma_don_hang' => $donhang->ma_don_hang,
                'khach_hang' => $donhang->ho_ten_nguoi_nhan,
                'so_dien_thoai' => $donhang->so_dien_thoai,
                'tong_thanh_toan' => $donhang->tong_thanh_toan,
                'duong_dan' => route('quantri.donhang.show', $donhang),
            ],
            'da_doc' => false,
        ]);

        event(new DonhangMoiEvent([
            'id' => $thongbao->id,
            'tieu_de' => $thongbao->tieu_de,
            'noi_dung' => $thongbao->noi_dung,
            'loai' => $thongbao->loai,
            'ma_don_hang' => $donhang->ma_don_hang,
            'khach_hang' => $donhang->ho_ten_nguoi_nhan,
            'tong_thanh_toan' => dinh_dang_tien($donhang->tong_thanh_toan),
            'duong_dan' => route('quantri.donhang.show', $donhang),
            'thoi_gian' => dinh_dang_ngay_gio($thongbao->created_at),
        ]));

        return $thongbao;
    }

    public function demChuaDoc(): int
    {
        return Thongbao::query()
            ->where('da_doc', false)
            ->count();
    }

    public function layThongbaoMoiNhat(int $soLuong = 6)
    {
        return Thongbao::query()
            ->orderByDesc('id')
            ->limit($soLuong)
            ->get();
    }

    public function layDanhSach()
    {
        return Thongbao::query()
            ->orderByDesc('id')
            ->paginate(15);
    }

    public function danhDauDaDoc(Thongbao $thongbao): bool
    {
        return $thongbao->update([
            'da_doc' => true,
        ]);
    }

    public function danhDauTatCaDaDoc(): void
    {
        Thongbao::query()
            ->where('da_doc', false)
            ->update([
                'da_doc' => true,
            ]);
    }
}
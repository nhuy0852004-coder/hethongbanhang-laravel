<?php

if (! function_exists('dinh_dang_tien')) {
    function dinh_dang_tien($so_tien): string
    {
        return number_format((int) $so_tien, 0, ',', '.') . ' ₫';
    }
}

if (! function_exists('dinh_dang_so_luong')) {
    function dinh_dang_so_luong($so_luong): string
    {
        return number_format((int) $so_luong, 0, ',', '.');
    }
}

if (! function_exists('dem_gio_hang')) {
    function dem_gio_hang(): int
    {
        return collect(session('giohang', []))->sum('so_luong');
    }
}

if (! function_exists('ten_trang_thai_don_hang')) {
    function ten_trang_thai_don_hang(string $trangThai): string
    {
        return match ($trangThai) {
            'cho_xac_nhan' => 'Chờ xác nhận',
            'da_xac_nhan' => 'Đã xác nhận',
            'dang_giao_hang' => 'Đang giao hàng',
            'hoan_thanh' => 'Hoàn thành',
            'da_huy' => 'Đã hủy',
            default => 'Không xác định',
        };
    }
}

if (! function_exists('class_trang_thai_don_hang')) {
    function class_trang_thai_don_hang(string $trangThai): string
    {
        return match ($trangThai) {
            'cho_xac_nhan' => 'badge-donhang-cho-xac-nhan',
            'da_xac_nhan' => 'badge-donhang-da-xac-nhan',
            'dang_giao_hang' => 'badge-donhang-dang-giao',
            'hoan_thanh' => 'badge-donhang-hoan-thanh',
            'da_huy' => 'badge-donhang-da-huy',
            default => 'badge-donhang-mac-dinh',
        };
    }
}

if (! function_exists('ten_phuong_thuc_thanh_toan')) {
    function ten_phuong_thuc_thanh_toan(?string $phuongThuc): string
    {
        return match ($phuongThuc) {
            'cod' => 'Thanh toán khi nhận hàng',
            'chuyen_khoan' => 'Chuyển khoản ngân hàng',
            default => 'Không xác định',
        };
    }
}
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
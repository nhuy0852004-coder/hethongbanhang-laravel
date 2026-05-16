<?php

namespace Database\Seeders;

use App\Models\Danhmuc;
use App\Models\Sanpham;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SanphamSeeder extends Seeder
{
    public function run(): void
    {
        $danhmucDauTien = Danhmuc::first();

        if (! $danhmucDauTien) {
            return;
        }

        for ($i = 1; $i <= 8; $i++) {
            Sanpham::updateOrCreate(
                ['ma_san_pham' => 'SP' . str_pad($i, 4, '0', STR_PAD_LEFT)],
                [
                    'danhmuc_id' => $danhmucDauTien->id,
                    'ten_san_pham' => 'Sản phẩm mẫu ' . $i,
                    'duong_dan' => Str::slug('Sản phẩm mẫu ' . $i),
                    'gia_ban' => 120000 + ($i * 10000),
                    'gia_khuyen_mai' => $i % 2 === 0 ? 99000 + ($i * 10000) : null,
                    'so_luong_ton' => 10 + $i,
                    'mo_ta_ngan' => 'Mô tả ngắn cho sản phẩm mẫu ' . $i,
                    'mo_ta_chi_tiet' => 'Đây là mô tả chi tiết của sản phẩm mẫu ' . $i,
                    'trang_thai' => 'hien_thi',
                ]
            );
        }
    }
}
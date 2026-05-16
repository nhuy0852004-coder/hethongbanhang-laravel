<?php

namespace Database\Seeders;

use App\Models\Danhmuc;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DanhmucSeeder extends Seeder
{
    public function run(): void
    {
        $danhmuc = [
            'Áo nam',
            'Áo nữ',
            'Quần nam',
            'Quần nữ',
            'Phụ kiện',
        ];

        foreach ($danhmuc as $index => $ten) {
            Danhmuc::updateOrCreate(
                ['duong_dan' => Str::slug($ten)],
                [
                    'ten_danh_muc' => $ten,
                    'mo_ta' => 'Danh mục ' . mb_strtolower($ten),
                    'thu_tu' => $index + 1,
                    'trang_thai' => 'hoat_dong',
                ]
            );
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Nguoidung;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NguoidungSeeder extends Seeder
{
    public function run(): void
    {
        Nguoidung::updateOrCreate(
            ['email' => 'nhuy08052004@gmail.com'],
            [
                'ho_ten' => 'Nhuy',
                'so_dien_thoai' => null,
                'mat_khau' => Hash::make('12345678'),
                'vai_tro' => 'quan_tri',
                'trang_thai' => 'hoat_dong',
            ]
        );
    }
}
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
            ['email' => 'admin@gmail.com'],
            [
                'ho_ten' => 'Quản trị viên',
                'so_dien_thoai' => '0900000000',
                'mat_khau' => Hash::make('12345678'),
                'vai_tro' => 'quan_tri',
                'trang_thai' => 'hoat_dong',
            ]
        );
    }
}
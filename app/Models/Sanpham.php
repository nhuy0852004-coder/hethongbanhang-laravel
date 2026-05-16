<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    protected $table = 'sanpham';

    protected $fillable = [
        'danhmuc_id',
        'ten_san_pham',
        'duong_dan',
        'ma_san_pham',
        'anh_dai_dien',
        'gia_ban',
        'gia_khuyen_mai',
        'so_luong_ton',
        'mo_ta_ngan',
        'mo_ta_chi_tiet',
        'trang_thai',
    ];

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'danhmuc_id');
    }

    public function getGiaHienThiAttribute(): int
    {
        return $this->gia_khuyen_mai ?: $this->gia_ban;
    }
}
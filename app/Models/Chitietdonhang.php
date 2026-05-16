<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    protected $table = 'chitietdonhang';

    protected $fillable = [
        'donhang_id',
        'sanpham_id',
        'ten_san_pham',
        'anh_san_pham',
        'gia_ban',
        'so_luong',
        'thanh_tien',
    ];

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'donhang_id');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanpham_id');
    }
}
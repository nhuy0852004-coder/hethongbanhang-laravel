<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    protected $table = 'khachhang';

    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'tinh_thanh',
        'quan_huyen',
        'phuong_xa',
    ];

    public function donhang()
    {
        return $this->hasMany(Donhang::class, 'khachhang_id');
    }
}
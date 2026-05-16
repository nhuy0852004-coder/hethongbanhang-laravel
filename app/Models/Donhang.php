<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $table = 'donhang';

    protected $fillable = [
        'ma_don_hang',
        'khachhang_id',
        'ho_ten_nguoi_nhan',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'tinh_thanh',
        'quan_huyen',
        'phuong_xa',
        'tong_tien_hang',
        'phi_van_chuyen',
        'giam_gia',
        'tong_thanh_toan',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'ghi_chu',
    ];

    public function khachhang()
    {
        return $this->belongsTo(Khachhang::class, 'khachhang_id');
    }

    public function chitietdonhang()
    {
        return $this->hasMany(Chitietdonhang::class, 'donhang_id');
    }
}
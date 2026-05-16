<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    protected $table = 'danhmuc';

    protected $fillable = [
        'danhmuc_cha_id',
        'ten_danh_muc',
        'duong_dan',
        'mo_ta',
        'thu_tu',
        'trang_thai',
    ];

    public function danhmucCha()
    {
        return $this->belongsTo(Danhmuc::class, 'danhmuc_cha_id');
    }

    public function danhmucCon()
    {
        return $this->hasMany(Danhmuc::class, 'danhmuc_cha_id');
    }

    public function sanpham()
    {
        return $this->hasMany(Sanpham::class, 'danhmuc_id');
    }
}
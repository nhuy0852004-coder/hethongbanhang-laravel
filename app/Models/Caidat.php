<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caidat extends Model
{
    protected $table = 'caidat';

    protected $fillable = [
        'ten_cua_hang',
        'logo',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'chinh_sach_van_chuyen',
        'chinh_sach_doi_tra',
    ];
}
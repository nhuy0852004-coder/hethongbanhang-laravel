<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thongbao extends Model
{
    protected $table = 'thongbao';

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'loai',
        'du_lieu',
        'da_doc',
    ];

    protected $casts = [
        'du_lieu' => 'array',
        'da_doc' => 'boolean',
    ];
}
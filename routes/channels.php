<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('quantri.thongbao', function ($nguoidung) {
    return $nguoidung && $nguoidung->vai_tro === 'quan_tri';
});
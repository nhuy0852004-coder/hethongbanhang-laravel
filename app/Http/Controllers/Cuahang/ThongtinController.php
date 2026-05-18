<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Models\Caidat;

class ThongtinController extends Controller
{
    public function chinhSachVanChuyen()
    {
        $caidat = Caidat::query()->first();

        return view('cuahang.thongtin.chinhsachvanchuyen', compact('caidat'));
    }

    public function chinhSachDoiTra()
    {
        $caidat = Caidat::query()->first();

        return view('cuahang.thongtin.chinhsachdoitra', compact('caidat'));
    }

    public function lienHe()
    {
        $caidat = Caidat::query()->first();

        return view('cuahang.thongtin.lienhe', compact('caidat'));
    }
}

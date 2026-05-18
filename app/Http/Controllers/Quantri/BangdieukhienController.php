<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Services\BaocaoService;

class BangdieukhienController extends Controller
{
    public function __construct(
        protected BaocaoService $baocaoService
    ) {
    }

    public function index()
    {
        $duLieu = $this->baocaoService->duLieuBangDieuKhien();

        return view('quantri.bangdieukhien.index', $duLieu);
    }
}

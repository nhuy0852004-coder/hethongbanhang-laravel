<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Services\CuahangService;

class TrangchuController extends Controller
{
    public function __construct(
        protected CuahangService $cuahangService
    ) {
    }

    public function index()
    {
        $duLieu = $this->cuahangService->duLieuTrangChu();

        return view('cuahang.trangchu.index', $duLieu);
    }
}
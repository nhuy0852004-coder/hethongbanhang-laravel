<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Services\BaocaoService;
use Illuminate\Http\Request;

class BaocaoController extends Controller
{
    public function __construct(
        protected BaocaoService $baocaoService
    ) {
    }

    public function doanhthu(Request $request)
    {
        $duLieu = $this->baocaoService->duLieuBaoCaoDoanhThu(
            $request->get('tu_ngay'),
            $request->get('den_ngay')
        );

        return view('quantri.baocao.doanhthu', $duLieu);
    }
}

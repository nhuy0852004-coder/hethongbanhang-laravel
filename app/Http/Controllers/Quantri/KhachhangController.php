<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Models\Khachhang;
use App\Services\KhachhangService;
use Illuminate\Http\Request;

class KhachhangController extends Controller
{
    public function __construct(
        protected KhachhangService $khachhangService
    ) {
    }

    public function index(Request $request)
    {
        $boLoc = [
            'tu_khoa' => $request->get('tu_khoa'),
        ];

        $danhsachKhachhang = $this->khachhangService->layDanhSach($boLoc);

        return view('quantri.khachhang.index', compact(
            'boLoc',
            'danhsachKhachhang'
        ));
    }

    public function show(Khachhang $khachhang)
    {
        $duLieu = $this->khachhangService->duLieuChiTiet($khachhang);

        return view('quantri.khachhang.chitiet', $duLieu);
    }
}

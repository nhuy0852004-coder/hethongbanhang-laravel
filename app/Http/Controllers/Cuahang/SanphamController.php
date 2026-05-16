<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Services\CuahangService;
use Illuminate\Http\Request;

class SanphamController extends Controller
{
    public function __construct(
        protected CuahangService $cuahangService
    ) {
    }

    public function index(Request $request)
    {
        $boLoc = [
            'tu_khoa' => $request->get('tu_khoa'),
            'danhmuc' => $request->get('danhmuc'),
            'gia_tu' => $this->chuyenTienThanhSo($request->get('gia_tu')),
            'gia_den' => $this->chuyenTienThanhSo($request->get('gia_den')),
            'sap_xep' => $request->get('sap_xep', 'moi_nhat'),
        ];

        $duLieu = $this->cuahangService->duLieuDanhSachSanpham($boLoc);

        return view('cuahang.sanpham.index', $duLieu);
    }

    public function show(string $duongDan)
    {
        $duLieu = $this->cuahangService->duLieuChiTietSanpham($duongDan);

        return view('cuahang.sanpham.chitiet', $duLieu);
    }

    protected function chuyenTienThanhSo($giaTri): ?int
    {
        if (!$giaTri) {
            return null;
        }

        return (int) preg_replace('/[^0-9]/', '', (string) $giaTri);
    }
}
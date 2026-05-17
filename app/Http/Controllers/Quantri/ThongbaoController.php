<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Models\Thongbao;
use App\Services\ThongbaoService;

class ThongbaoController extends Controller
{
    public function __construct(
        protected ThongbaoService $thongbaoService
    ) {
    }

    public function index()
    {
        $danhsachThongbao = $this->thongbaoService->layDanhSach();

        return view('quantri.thongbao.index', compact('danhsachThongbao'));
    }

    public function danhDauDaDoc(Thongbao $thongbao)
    {
        $this->thongbaoService->danhDauDaDoc($thongbao);

        return back()->with('thanhcong', 'Đã đánh dấu thông báo là đã đọc.');
    }

    public function danhDauTatCaDaDoc()
    {
        $this->thongbaoService->danhDauTatCaDaDoc();

        return back()->with('thanhcong', 'Đã đánh dấu tất cả thông báo là đã đọc.');
    }
}
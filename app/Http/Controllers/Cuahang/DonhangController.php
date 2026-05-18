<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Http\Requests\TracuuDonhangRequest;
use App\Services\DonhangService;

class DonhangController extends Controller
{
    public function __construct(
        protected DonhangService $donhangService
    ) {
    }

    public function tracuu()
    {
        return view('cuahang.donhang.tracuu');
    }

    public function xulyTracuu(TracuuDonhangRequest $request)
    {
        $duLieu = $request->validated();

        $donhang = $this->donhangService->traCuuDonHang(
            $duLieu['ma_don_hang'],
            $duLieu['so_dien_thoai']
        );

        if (! $donhang) {
            return back()
                ->withInput()
                ->with('loi', 'Không tìm thấy đơn hàng phù hợp với thông tin đã nhập.');
        }

        return view('cuahang.donhang.chitiet', compact('donhang'));
    }
}

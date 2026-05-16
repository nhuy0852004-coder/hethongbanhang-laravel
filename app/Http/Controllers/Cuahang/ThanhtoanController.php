<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Http\Requests\LuuDonhangRequest;
use App\Services\DonhangService;
use App\Services\GiohangService;
use RuntimeException;
use Throwable;

class ThanhtoanController extends Controller
{
    public function __construct(
        protected GiohangService $giohangService,
        protected DonhangService $donhangService
    ) {
    }

    public function index()
    {
        if ($this->giohangService->trong()) {
            return redirect()
                ->route('cuahang.giohang.index')
                ->with('loi', 'Giỏ hàng đang trống, vui lòng chọn sản phẩm trước khi thanh toán.');
        }

        return view('cuahang.thanhtoan.index', [
            'gioHang' => $this->giohangService->layDanhSach(),
            'tongTien' => $this->giohangService->tinhTongTien(),
        ]);
    }

    public function dathang(LuuDonhangRequest $request)
    {
        try {
            $donhang = $this->donhangService->taoTuGioHang(
                $request->validated(),
                $this->giohangService
            );

            $this->giohangService->xoatatca();

            return redirect()
                ->route('cuahang.thanhtoan.thanhcong', $donhang->ma_don_hang)
                ->with('thanhcong', 'Đặt hàng thành công.');
        } catch (RuntimeException $e) {
            return back()
                ->withInput()
                ->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể đặt hàng. Vui lòng thử lại.');
        }
    }

    public function thanhcong(string $maDonHang)
    {
        $donhang = $this->donhangService->layTheoMaDonHang($maDonHang);

        return view('cuahang.thanhtoan.thanhcong', compact('donhang'));
    }
}
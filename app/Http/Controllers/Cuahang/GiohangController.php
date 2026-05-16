<?php

namespace App\Http\Controllers\Cuahang;

use App\Http\Controllers\Controller;
use App\Models\Sanpham;
use App\Services\GiohangService;
use Illuminate\Http\Request;
use RuntimeException;
use Throwable;

class GiohangController extends Controller
{
    public function __construct(
        protected GiohangService $giohangService
    ) {
    }

    public function index()
    {
        return view('cuahang.giohang.index', [
            'gioHang' => $this->giohangService->layDanhSach(),
            'tongTien' => $this->giohangService->tinhTongTien(),
        ]);
    }

    public function them(Request $request, Sanpham $sanpham)
    {
        $request->validate(
            [
                'so_luong' => ['nullable', 'integer', 'min:1', 'max:999'],
            ],
            [
                'so_luong.integer' => 'Số lượng phải là số nguyên.',
                'so_luong.min' => 'Số lượng phải lớn hơn 0.',
                'so_luong.max' => 'Số lượng quá lớn.',
            ]
        );

        try {
            $this->giohangService->them($sanpham, (int) $request->get('so_luong', 1));

            return redirect()
                ->route('cuahang.giohang.index')
                ->with('thanhcong', 'Đã thêm sản phẩm vào giỏ hàng.');
        } catch (RuntimeException $e) {
            return back()->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể thêm sản phẩm vào giỏ hàng.');
        }
    }

    public function capnhat(Request $request)
    {
        $request->validate(
            [
                'so_luong' => ['required', 'array'],
                'so_luong.*' => ['required', 'integer', 'min:0', 'max:999'],
            ],
            [
                'so_luong.required' => 'Dữ liệu giỏ hàng không hợp lệ.',
                'so_luong.array' => 'Dữ liệu giỏ hàng không hợp lệ.',
                'so_luong.*.integer' => 'Số lượng phải là số nguyên.',
                'so_luong.*.min' => 'Số lượng không được nhỏ hơn 0.',
                'so_luong.*.max' => 'Số lượng quá lớn.',
            ]
        );

        try {
            $this->giohangService->capnhat($request->input('so_luong', []));

            return back()->with('thanhcong', 'Cập nhật giỏ hàng thành công.');
        } catch (RuntimeException $e) {
            return back()->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể cập nhật giỏ hàng.');
        }
    }

    public function xoa(int $sanphamId)
    {
        $this->giohangService->xoa($sanphamId);

        return back()->with('thanhcong', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function xoatatca()
    {
        $this->giohangService->xoatatca();

        return back()->with('thanhcong', 'Đã xóa toàn bộ giỏ hàng.');
    }
}
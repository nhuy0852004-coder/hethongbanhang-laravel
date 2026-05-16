<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapnhatTrangthaiDonhangRequest;
use App\Models\Donhang;
use App\Services\DonhangService;
use Illuminate\Http\Request;
use RuntimeException;
use Throwable;

class DonhangController extends Controller
{
    public function __construct(
        protected DonhangService $donhangService
    ) {
    }

    public function index(Request $request)
    {
        $boLoc = [
            'tu_khoa' => $request->get('tu_khoa'),
            'trang_thai' => $request->get('trang_thai'),
            'tu_ngay' => $request->get('tu_ngay'),
            'den_ngay' => $request->get('den_ngay'),
        ];

        $danhsachDonhang = $this->donhangService->layDanhSach($boLoc);

        return view('quantri.donhang.index', compact(
            'boLoc',
            'danhsachDonhang'
        ));
    }

    public function show(Donhang $donhang)
    {
        $donhang->load([
            'khachhang',
            'chitietdonhang.sanpham',
        ]);

        return view('quantri.donhang.chitiet', compact('donhang'));
    }

    public function update(CapnhatTrangthaiDonhangRequest $request, Donhang $donhang)
    {
        try {
            $this->donhangService->capnhatTrangThai(
                $donhang,
                $request->validated('trang_thai')
            );

            return back()->with('thanhcong', 'Cập nhật trạng thái đơn hàng thành công.');
        } catch (RuntimeException $e) {
            return back()->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể cập nhật trạng thái đơn hàng.');
        }
    }
}
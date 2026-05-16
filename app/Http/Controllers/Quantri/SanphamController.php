<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapnhatSanphamRequest;
use App\Http\Requests\LuuSanphamRequest;
use App\Models\Danhmuc;
use App\Models\Sanpham;
use App\Services\SanphamService;
use Illuminate\Http\Request;
use Throwable;

class SanphamController extends Controller
{
    public function __construct(
        protected SanphamService $sanphamService
    ) {
    }

    public function index(Request $request)
    {
        $boLoc = [
            'tu_khoa' => $request->get('tu_khoa'),
            'danhmuc_id' => $request->get('danhmuc_id'),
            'trang_thai' => $request->get('trang_thai'),
        ];

        $danhsachSanpham = $this->sanphamService->layDanhSach($boLoc);

        $danhsachDanhmuc = Danhmuc::query()
            ->where('trang_thai', 'hoat_dong')
            ->orderBy('thu_tu')
            ->orderBy('ten_danh_muc')
            ->get();

        return view('quantri.sanpham.index', compact(
            'boLoc',
            'danhsachSanpham',
            'danhsachDanhmuc'
        ));
    }

    public function store(LuuSanphamRequest $request)
    {
        try {
            $this->sanphamService->tao($request->validated());

            return redirect()
                ->route('quantri.sanpham.index')
                ->with('thanhcong', 'Thêm sản phẩm thành công.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể thêm sản phẩm. Vui lòng thử lại.');
        }
    }

    public function update(CapnhatSanphamRequest $request, Sanpham $sanpham)
    {
        try {
            $this->sanphamService->capnhat($sanpham, $request->validated());

            return redirect()
                ->route('quantri.sanpham.index')
                ->with('thanhcong', 'Cập nhật sản phẩm thành công.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể cập nhật sản phẩm. Vui lòng thử lại.');
        }
    }

    public function destroy(Sanpham $sanpham)
    {
        try {
            $this->sanphamService->xoa($sanpham);

            return redirect()
                ->route('quantri.sanpham.index')
                ->with('thanhcong', 'Xóa sản phẩm thành công.');
        } catch (Throwable $e) {
            return back()
                ->with('loi', 'Không thể xóa sản phẩm. Vui lòng thử lại.');
        }
    }

    public function doiTrangThai(Sanpham $sanpham)
    {
        try {
            $this->sanphamService->doiTrangThai($sanpham);

            return back()->with('thanhcong', 'Cập nhật trạng thái sản phẩm thành công.');
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể cập nhật trạng thái sản phẩm. Vui lòng thử lại.');
        }
    }
}
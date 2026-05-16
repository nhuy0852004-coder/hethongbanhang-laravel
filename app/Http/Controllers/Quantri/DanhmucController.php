<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapnhatDanhmucRequest;
use App\Http\Requests\LuuDanhmucRequest;
use App\Models\Danhmuc;
use App\Services\DanhmucService;
use Illuminate\Http\Request;
use RuntimeException;
use Throwable;

class DanhmucController extends Controller
{
    public function __construct(
        protected DanhmucService $danhmucService
    ) {
    }

    public function index(Request $request)
    {
        $boLoc = [
            'tu_khoa' => $request->get('tu_khoa'),
            'trang_thai' => $request->get('trang_thai'),
        ];

        $danhsachDanhmuc = $this->danhmucService->layDanhSach($boLoc);
        $danhsachDanhmucCha = $this->danhmucService->layDanhmucCha();

        return view('quantri.danhmuc.index', compact(
            'boLoc',
            'danhsachDanhmuc',
            'danhsachDanhmucCha'
        ));
    }

    public function store(LuuDanhmucRequest $request)
    {
        try {
            $this->danhmucService->tao($request->validated());

            return redirect()
                ->route('quantri.danhmuc.index')
                ->with('thanhcong', 'Thêm danh mục thành công.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể thêm danh mục. Vui lòng thử lại.');
        }
    }

    public function update(CapnhatDanhmucRequest $request, Danhmuc $danhmuc)
    {
        try {
            $this->danhmucService->capnhat($danhmuc, $request->validated());

            return redirect()
                ->route('quantri.danhmuc.index')
                ->with('thanhcong', 'Cập nhật danh mục thành công.');
        } catch (RuntimeException $e) {
            return back()
                ->withInput()
                ->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể cập nhật danh mục. Vui lòng thử lại.');
        }
    }

    public function destroy(Danhmuc $danhmuc)
    {
        try {
            $this->danhmucService->xoa($danhmuc);

            return redirect()
                ->route('quantri.danhmuc.index')
                ->with('thanhcong', 'Xóa danh mục thành công.');
        } catch (RuntimeException $e) {
            return back()->with('loi', $e->getMessage());
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể xóa danh mục. Vui lòng thử lại.');
        }
    }

    public function doiTrangThai(Danhmuc $danhmuc)
    {
        try {
            $this->danhmucService->doiTrangThai($danhmuc);

            return back()->with('thanhcong', 'Cập nhật trạng thái danh mục thành công.');
        } catch (Throwable $e) {
            return back()->with('loi', 'Không thể cập nhật trạng thái. Vui lòng thử lại.');
        }
    }
}
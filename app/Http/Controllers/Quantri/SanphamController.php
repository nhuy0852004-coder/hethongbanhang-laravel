<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Http\Requests\LuuSanphamRequest;
use App\Models\Danhmuc;
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
}
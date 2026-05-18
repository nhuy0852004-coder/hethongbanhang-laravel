<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapnhatCaidatRequest;
use App\Services\CaidatService;
use Throwable;

class CaidatController extends Controller
{
    public function __construct(
        protected CaidatService $caidatService
    ) {
    }

    public function index()
    {
        $caidat = $this->caidatService->layCaidat();

        return view('quantri.caidat.index', compact('caidat'));
    }

    public function capnhat(CapnhatCaidatRequest $request)
    {
        try {
            $this->caidatService->capnhat($request->validated());

            return redirect()
                ->route('quantri.caidat.index')
                ->with('thanhcong', 'Cập nhật cài đặt cửa hàng thành công.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('loi', 'Không thể cập nhật cài đặt. Vui lòng thử lại.');
        }
    }
}

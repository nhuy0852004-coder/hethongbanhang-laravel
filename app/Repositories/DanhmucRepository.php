<?php

namespace App\Repositories;

use App\Models\Danhmuc;

class DanhmucRepository
{
    public function layDanhSach(array $boLoc)
    {
        return Danhmuc::query()
            ->with('danhmucCha')
            ->withCount(['sanpham', 'danhmucCon'])
            ->when(!empty($boLoc['tu_khoa']), function ($query) use ($boLoc) {
                $query->where(function ($truyVan) use ($boLoc) {
                    $truyVan->where('ten_danh_muc', 'like', '%' . $boLoc['tu_khoa'] . '%')
                        ->orWhere('mo_ta', 'like', '%' . $boLoc['tu_khoa'] . '%');
                });
            })
            ->when(!empty($boLoc['trang_thai']), function ($query) use ($boLoc) {
                $query->where('trang_thai', $boLoc['trang_thai']);
            })
            ->orderBy('thu_tu')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();
    }

    public function layDanhmucCha(?int $boQuaId = null)
    {
        return Danhmuc::query()
            ->when($boQuaId, function ($query) use ($boQuaId) {
                $query->where('id', '!=', $boQuaId);
            })
            ->orderBy('thu_tu')
            ->orderBy('ten_danh_muc')
            ->get();
    }

    public function tao(array $duLieu): Danhmuc
    {
        return Danhmuc::create($duLieu);
    }

    public function capnhat(Danhmuc $danhmuc, array $duLieu): bool
    {
        return $danhmuc->update($duLieu);
    }

    public function xoa(Danhmuc $danhmuc): bool
    {
        return $danhmuc->delete();
    }

    public function demSanpham(Danhmuc $danhmuc): int
    {
        return $danhmuc->sanpham()->count();
    }

    public function demDanhmucCon(Danhmuc $danhmuc): int
    {
        return $danhmuc->danhmucCon()->count();
    }

    public function tonTaiDuongDan(string $duongDan, ?int $boQuaId = null): bool
    {
        return Danhmuc::query()
            ->where('duong_dan', $duongDan)
            ->when($boQuaId, function ($query) use ($boQuaId) {
                $query->where('id', '!=', $boQuaId);
            })
            ->exists();
    }
}

<?php

namespace App\Services;

use App\Models\Danhmuc;
use App\Repositories\DanhmucRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class DanhmucService
{
    public function __construct(
        protected DanhmucRepository $danhmucRepository
    ) {
    }

    public function layDanhSach(array $boLoc)
    {
        return $this->danhmucRepository->layDanhSach($boLoc);
    }

    public function layDanhmucCha(?int $boQuaId = null)
    {
        return $this->danhmucRepository->layDanhmucCha($boQuaId);
    }

    public function tao(array $duLieu): Danhmuc
    {
        return DB::transaction(function () use ($duLieu) {
            $duLieu['thu_tu'] = $duLieu['thu_tu'] ?? 0;
            $duLieu['duong_dan'] = $this->taoDuongDanDuyNhat($duLieu['ten_danh_muc']);

            return $this->danhmucRepository->tao($duLieu);
        });
    }

    public function capnhat(Danhmuc $danhmuc, array $duLieu): bool
    {
        return DB::transaction(function () use ($danhmuc, $duLieu) {
            if (!empty($duLieu['danhmuc_cha_id']) && (int) $duLieu['danhmuc_cha_id'] === (int) $danhmuc->id) {
                throw new RuntimeException('Danh mục không thể chọn chính nó làm danh mục cha.');
            }

            $duLieu['thu_tu'] = $duLieu['thu_tu'] ?? 0;
            $duLieu['duong_dan'] = $this->taoDuongDanDuyNhat($duLieu['ten_danh_muc'], $danhmuc->id);

            return $this->danhmucRepository->capnhat($danhmuc, $duLieu);
        });
    }

    public function xoa(Danhmuc $danhmuc): bool
    {
        return DB::transaction(function () use ($danhmuc) {
            if ($this->danhmucRepository->demDanhmucCon($danhmuc) > 0) {
                throw new RuntimeException('Không thể xóa danh mục đang có danh mục con.');
            }

            if ($this->danhmucRepository->demSanpham($danhmuc) > 0) {
                throw new RuntimeException('Không thể xóa danh mục đang có sản phẩm.');
            }

            return $this->danhmucRepository->xoa($danhmuc);
        });
    }

    public function doiTrangThai(Danhmuc $danhmuc): bool
    {
        $trangThaiMoi = $danhmuc->trang_thai === 'hoat_dong' ? 'tam_an' : 'hoat_dong';

        return $this->danhmucRepository->capnhat($danhmuc, [
            'trang_thai' => $trangThaiMoi,
        ]);
    }

    protected function taoDuongDanDuyNhat(string $tenDanhMuc, ?int $boQuaId = null): string
    {
        $duongDanGoc = Str::slug($tenDanhMuc);
        $duongDan = $duongDanGoc;
        $soThuTu = 1;

        while ($this->danhmucRepository->tonTaiDuongDan($duongDan, $boQuaId)) {
            $duongDan = $duongDanGoc . '-' . $soThuTu;
            $soThuTu++;
        }

        return $duongDan;
    }
}
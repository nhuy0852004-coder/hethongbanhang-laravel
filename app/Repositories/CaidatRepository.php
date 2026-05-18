<?php

namespace App\Repositories;

use App\Models\Caidat;

class CaidatRepository
{
    public function layCaidat(): Caidat
    {
        return Caidat::query()->firstOrCreate(
            ['id' => 1],
            [
                'ten_cua_hang' => 'Bán Hàng Pro',
                'so_dien_thoai' => '0900000000',
                'email' => 'hotro@banhangpro.vn',
                'dia_chi' => 'Việt Nam',
                'chinh_sach_van_chuyen' => 'Cửa hàng hỗ trợ giao hàng toàn quốc. Thời gian giao hàng tùy theo khu vực nhận hàng.',
                'chinh_sach_doi_tra' => 'Khách hàng được hỗ trợ đổi trả theo chính sách của cửa hàng nếu sản phẩm lỗi hoặc không đúng mô tả.',
            ]
        );
    }

    public function capnhat(Caidat $caidat, array $duLieu): bool
    {
        return $caidat->update($duLieu);
    }
}

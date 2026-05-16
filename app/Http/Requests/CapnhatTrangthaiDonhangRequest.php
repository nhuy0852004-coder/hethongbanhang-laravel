<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapnhatTrangthaiDonhangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trang_thai' => [
                'required',
                'in:cho_xac_nhan,da_xac_nhan,dang_giao_hang,hoan_thanh,da_huy',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'trang_thai.required' => 'Vui lòng chọn trạng thái đơn hàng.',
            'trang_thai.in' => 'Trạng thái đơn hàng không hợp lệ.',
        ];
    }
}
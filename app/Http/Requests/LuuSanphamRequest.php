<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LuuSanphamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'gia_ban' => $this->chuyenTienThanhSo($this->gia_ban),
            'gia_khuyen_mai' => $this->gia_khuyen_mai
                ? $this->chuyenTienThanhSo($this->gia_khuyen_mai)
                : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'danhmuc_id' => ['required', 'exists:danhmuc,id'],
            'ten_san_pham' => ['required', 'string', 'max:255'],
            'ma_san_pham' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('sanpham', 'ma_san_pham'),
            ],
            'anh_dai_dien' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'gia_ban' => ['required', 'integer', 'min:1000'],
            'gia_khuyen_mai' => ['nullable', 'integer', 'min:1000', 'lt:gia_ban'],
            'so_luong_ton' => ['required', 'integer', 'min:0', 'max:999999'],
            'mo_ta_ngan' => ['nullable', 'string', 'max:500'],
            'mo_ta_chi_tiet' => ['nullable', 'string'],
            'trang_thai' => ['required', 'in:hien_thi,an,het_hang'],
        ];
    }

    public function messages(): array
    {
        return [
            'danhmuc_id.required' => 'Vui lòng chọn danh mục.',
            'danhmuc_id.exists' => 'Danh mục không hợp lệ.',

            'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 50 ký tự.',

            'anh_dai_dien.image' => 'Tệp tải lên phải là hình ảnh.',
            'anh_dai_dien.mimes' => 'Ảnh sản phẩm phải có định dạng jpg, jpeg, png hoặc webp.',
            'anh_dai_dien.max' => 'Ảnh sản phẩm không được vượt quá 2MB.',

            'gia_ban.required' => 'Vui lòng nhập giá bán.',
            'gia_ban.integer' => 'Giá bán chỉ được nhập số.',
            'gia_ban.min' => 'Giá bán phải từ 1.000 ₫ trở lên.',

            'gia_khuyen_mai.integer' => 'Giá khuyến mãi chỉ được nhập số.',
            'gia_khuyen_mai.min' => 'Giá khuyến mãi phải từ 1.000 ₫ trở lên.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá bán.',

            'so_luong_ton.required' => 'Vui lòng nhập số lượng tồn kho.',
            'so_luong_ton.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'so_luong_ton.min' => 'Số lượng tồn kho không được nhỏ hơn 0.',
            'so_luong_ton.max' => 'Số lượng tồn kho quá lớn.',

            'mo_ta_ngan.max' => 'Mô tả ngắn không được vượt quá 500 ký tự.',

            'trang_thai.required' => 'Vui lòng chọn trạng thái.',
            'trang_thai.in' => 'Trạng thái sản phẩm không hợp lệ.',
        ];
    }

    protected function chuyenTienThanhSo($giaTri): int
    {
        return (int) preg_replace('/[^0-9]/', '', (string) $giaTri);
    }
}
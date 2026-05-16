<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapnhatDanhmucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $danhmucId = $this->route('danhmuc')?->id;

        return [
            'ten_danh_muc' => ['required', 'string', 'max:255'],
            'danhmuc_cha_id' => ['nullable', 'exists:danhmuc,id', 'different:id'],
            'mo_ta' => ['nullable', 'string', 'max:1000'],
            'thu_tu' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'trang_thai' => ['required', 'in:hoat_dong,tam_an'],
        ];
    }

    public function messages(): array
    {
        return [
            'ten_danh_muc.required' => 'Vui lòng nhập tên danh mục.',
            'ten_danh_muc.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'danhmuc_cha_id.exists' => 'Danh mục cha không hợp lệ.',
            'danhmuc_cha_id.different' => 'Danh mục không thể chọn chính nó làm danh mục cha.',
            'mo_ta.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'thu_tu.integer' => 'Thứ tự phải là số nguyên.',
            'thu_tu.min' => 'Thứ tự không được nhỏ hơn 0.',
            'thu_tu.max' => 'Thứ tự không được lớn hơn 9999.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.',
            'trang_thai.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapnhatCaidatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_cua_hang' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'so_dien_thoai' => ['nullable', 'regex:/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'dia_chi' => ['nullable', 'string', 'max:500'],
            'chinh_sach_van_chuyen' => ['nullable', 'string', 'max:5000'],
            'chinh_sach_doi_tra' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'ten_cua_hang.required' => 'Vui lòng nhập tên cửa hàng.',
            'ten_cua_hang.max' => 'Tên cửa hàng không được vượt quá 255 ký tự.',

            'logo.image' => 'Logo phải là tệp hình ảnh.',
            'logo.mimes' => 'Logo phải có định dạng jpg, jpeg, png hoặc webp.',
            'logo.max' => 'Logo không được vượt quá 2MB.',

            'so_dien_thoai.regex' => 'Số điện thoại không đúng định dạng Việt Nam.',

            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'dia_chi.max' => 'Địa chỉ không được vượt quá 500 ký tự.',

            'chinh_sach_van_chuyen.max' => 'Chính sách vận chuyển quá dài.',
            'chinh_sach_doi_tra.max' => 'Chính sách đổi trả quá dài.',
        ];
    }
}

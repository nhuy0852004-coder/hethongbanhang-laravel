<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LuuDonhangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten_nguoi_nhan' => ['required', 'string', 'max:255'],
            'so_dien_thoai' => ['required', 'regex:/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/'],
            'email' => ['nullable', 'email', 'max:255'],

            'tinh_thanh' => ['nullable', 'string', 'max:100'],
            'quan_huyen' => ['nullable', 'string', 'max:100'],
            'phuong_xa' => ['nullable', 'string', 'max:100'],
            'dia_chi' => ['required', 'string', 'max:500'],

            'phuong_thuc_thanh_toan' => ['required', 'in:cod,chuyen_khoan'],
            'ghi_chu' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'ho_ten_nguoi_nhan.required' => 'Vui lòng nhập họ tên người nhận.',
            'ho_ten_nguoi_nhan.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.regex' => 'Số điện thoại không đúng định dạng Việt Nam.',

            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'tinh_thanh.string' => 'Tỉnh/thành không hợp lệ.',
            'quan_huyen.string' => 'Quận/huyện không hợp lệ.',
            'phuong_xa.string' => 'Phường/xã không hợp lệ.',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ cụ thể.',

            'phuong_thuc_thanh_toan.required' => 'Vui lòng chọn phương thức thanh toán.',
            'phuong_thuc_thanh_toan.in' => 'Phương thức thanh toán không hợp lệ.',

            'ghi_chu.max' => 'Ghi chú không được vượt quá 1000 ký tự.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TracuuDonhangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'ma_don_hang' => strtoupper(trim((string) $this->ma_don_hang)),
            'so_dien_thoai' => trim((string) $this->so_dien_thoai),
        ]);
    }

    public function rules(): array
    {
        return [
            'ma_don_hang' => ['required', 'string', 'max:50'],
            'so_dien_thoai' => ['required', 'regex:/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'ma_don_hang.required' => 'Vui lòng nhập mã đơn hàng.',
            'ma_don_hang.max' => 'Mã đơn hàng không hợp lệ.',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.regex' => 'Số điện thoại không đúng định dạng Việt Nam.',
        ];
    }
}

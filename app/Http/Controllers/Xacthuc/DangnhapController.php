<?php

namespace App\Http\Controllers\Xacthuc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangnhapController extends Controller
{
    public function index()
    {
        return view('xacthuc.dangnhap');
    }

    public function xuly(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'mat_khau' => ['required', 'min:6'],
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'mat_khau.required' => 'Vui lòng nhập mật khẩu.',
                'mat_khau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]
        );

        $thongtin = [
            'email' => $request->email,
            'password' => $request->mat_khau,
            'trang_thai' => 'hoat_dong',
        ];

        if (Auth::attempt($thongtin, $request->boolean('ghi_nho'))) {
            $request->session()->regenerate();

            if (Auth::user()->vai_tro !== 'quan_tri') {
                Auth::logout();

                return back()->with('loi', 'Tài khoản này không có quyền truy cập trang quản trị.');
            }

            return redirect()
                ->route('quantri.bangdieukhien')
                ->with('thanhcong', 'Đăng nhập thành công.');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('loi', 'Email hoặc mật khẩu không chính xác.');
    }

    public function dangxuat(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('dangnhap')
            ->with('thanhcong', 'Đăng xuất thành công.');
    }
}
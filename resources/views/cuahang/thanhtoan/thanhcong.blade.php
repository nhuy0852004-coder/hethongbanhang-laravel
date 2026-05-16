@extends('cuahang.layouts.ungdung')

@section('tieude', 'Đặt hàng thành công')

@section('noidung')
    <section class="container py-5">
        <div class="thanhtoan-thanhcong">
            <div class="thanhtoan-thanhcong-icon">
                <i class="bi bi-check2-circle"></i>
            </div>

            <h1>Đặt hàng thành công</h1>

            <p>
                Cảm ơn bạn đã đặt hàng. Cửa hàng sẽ liên hệ xác nhận đơn hàng trong thời gian sớm nhất.
            </p>

            <div class="donhang-thanhcong-info">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Mã đơn hàng</span>
                    <span class="fw-bold">{{ $donhang->ma_don_hang }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Người nhận</span>
                    <span class="fw-semibold">{{ $donhang->ho_ten_nguoi_nhan }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Số điện thoại</span>
                    <span class="fw-semibold">{{ $donhang->so_dien_thoai }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Trạng thái</span>
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                        Chờ xác nhận
                    </span>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Tổng thanh toán</span>
                    <span class="giohang-tongtien">{{ dinh_dang_tien($donhang->tong_thanh_toan) }}</span>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-primary">
                    Tiếp tục mua sắm
                </a>

                <a href="{{ route('trangchu') }}" class="btn btn-light border">
                    Về trang chủ
                </a>
            </div>
        </div>
    </section>
@endsection
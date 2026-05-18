@extends('quantri.layouts.ungdung')

@section('tieude', 'Chi tiết khách hàng')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Chi tiết khách hàng</h1>
            <p>Thông tin liên hệ và lịch sử mua hàng của khách</p>
        </div>

        <a href="{{ route('quantri.khachhang.index') }}" class="btn btn-light border">
            <i class="bi bi-arrow-left me-1"></i>
            Quay lại
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Tổng đơn hàng</div>
                <div class="the-thongke-value">{{ $thongKe['tong_don_hang'] }}</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Đơn hoàn thành</div>
                <div class="the-thongke-value">{{ $thongKe['tong_don_hoan_thanh'] }}</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Đơn đã hủy</div>
                <div class="the-thongke-value">{{ $thongKe['tong_don_da_huy'] }}</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Tổng chi tiêu</div>
                <div class="the-thongke-value text-danger">
                    {{ dinh_dang_tien($thongKe['tong_chi_tieu']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="khoi-noidung mb-3">
                <div class="text-center">
                    <div class="avatar-khachhang avatar-khachhang-large mx-auto">
                        {{ mb_substr($khachhang->ho_ten, 0, 1) }}
                    </div>

                    <h2 class="h5 fw-bold mt-3 mb-1">
                        {{ $khachhang->ho_ten }}
                    </h2>

                    <div class="text-muted">
                        Khách hàng #{{ $khachhang->id }}
                    </div>
                </div>

                <hr>

                <div class="thongtin-khachhang-list">
                    <div class="thongtin-khachhang-item">
                        <div class="text-muted small">Số điện thoại</div>
                        <div class="fw-semibold">{{ $khachhang->so_dien_thoai }}</div>
                    </div>

                    <div class="thongtin-khachhang-item">
                        <div class="text-muted small">Email</div>
                        <div class="fw-semibold">{{ $khachhang->email ?: 'Chưa có email' }}</div>
                    </div>

                    <div class="thongtin-khachhang-item">
                        <div class="text-muted small">Địa chỉ</div>

                        @if ($khachhang->dia_chi)
                            <div class="fw-semibold">
                                {{ $khachhang->dia_chi }},
                                {{ $khachhang->phuong_xa }},
                                {{ $khachhang->quan_huyen }},
                                {{ $khachhang->tinh_thanh }}
                            </div>
                        @else
                            <div class="fw-semibold">Chưa có địa chỉ</div>
                        @endif
                    </div>

                    <div class="thongtin-khachhang-item">
                        <div class="text-muted small">Ngày tạo hồ sơ</div>
                        <div class="fw-semibold">
                            {{ dinh_dang_ngay_gio($khachhang->created_at) }}
                        </div>
                    </div>

                    <div class="thongtin-khachhang-item">
                        <div class="text-muted small">Đơn gần nhất</div>

                        @if ($thongKe['don_gan_nhat'])
                            <div class="fw-semibold">
                                {{ $thongKe['don_gan_nhat']->ma_don_hang }}
                            </div>
                            <div class="text-muted small">
                                {{ dinh_dang_ngay_gio($thongKe['don_gan_nhat']->created_at) }}
                            </div>
                        @else
                            <div class="fw-semibold">Chưa có đơn hàng</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="khoi-noidung">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="khoi-noidung-title mb-1">Lịch sử đơn hàng</div>
                        <div class="text-muted small">
                            Danh sách đơn hàng khách đã đặt
                        </div>
                    </div>
                </div>

                @if ($lichSuDonHang->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle bang-quantri">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Thời gian</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Xem</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lichSuDonHang as $donhang)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-primary">
                                                {{ $donhang->ma_don_hang }}
                                            </div>

                                            <div class="text-muted small">
                                                {{ ten_phuong_thuc_thanh_toan($donhang->phuong_thuc_thanh_toan) }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="fw-semibold">
                                                {{ dinh_dang_ngay($donhang->created_at) }}
                                            </div>

                                            <div class="text-muted small">
                                                {{ dinh_dang_gio($donhang->created_at) }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $donhang->chitietdonhang_count }} sản phẩm
                                            </span>
                                        </td>

                                        <td>
                                            <div class="fw-bold text-danger">
                                                {{ dinh_dang_tien($donhang->tong_thanh_toan) }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge-trangthai {{ class_trang_thai_don_hang($donhang->trang_thai) }}">
                                                {{ ten_trang_thai_don_hang($donhang->trang_thai) }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <a href="{{ route('quantri.donhang.show', $donhang) }}"
                                               class="btn btn-sm btn-light border">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $lichSuDonHang->links() }}
                    </div>
                @else
                    <div class="trang-rong">
                        <div class="trang-rong-icon">
                            <i class="bi bi-receipt"></i>
                        </div>

                        <div class="fw-bold mt-3">Khách hàng chưa có đơn hàng</div>
                        <div class="text-muted mt-1">
                            Lịch sử đơn hàng sẽ hiển thị tại đây khi khách đặt mua.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

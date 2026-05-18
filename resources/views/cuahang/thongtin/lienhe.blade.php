@extends('cuahang.layouts.ungdung')

@section('tieude', 'Liên hệ')

@section('noidung')
    <section class="container py-4">
        <div class="trang-thongtin-hero">
            <div class="trang-thongtin-icon">
                <i class="bi bi-headset"></i>
            </div>

            <div>
                <h1>Liên hệ cửa hàng</h1>
                <p>Thông tin hỗ trợ khách hàng, địa chỉ cửa hàng và các kênh liên hệ chính thức.</p>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-5">
                <div class="trang-thongtin-card">
                    <h2>Thông tin liên hệ</h2>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-shop"></i>
                        <div>
                            <div class="text-muted small">Tên cửa hàng</div>
                            <div class="fw-semibold">
                                {{ $caidat->ten_cua_hang ?? 'Bán Hàng Pro' }}
                            </div>
                        </div>
                    </div>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <div class="text-muted small">Số điện thoại</div>
                            <div class="fw-semibold">
                                {{ $caidat->so_dien_thoai ?? 'Đang cập nhật' }}
                            </div>
                        </div>
                    </div>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">
                                {{ $caidat->email ?? 'Đang cập nhật' }}
                            </div>
                        </div>
                    </div>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <div class="text-muted small">Địa chỉ</div>
                            <div class="fw-semibold">
                                {{ $caidat->dia_chi ?? 'Đang cập nhật' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="trang-thongtin-card">
                    <h2>Hỗ trợ nhanh</h2>

                    <p class="text-muted">
                        Bạn có thể tra cứu đơn hàng hoặc xem chính sách cửa hàng trước khi liên hệ hỗ trợ.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('cuahang.donhang.tracuu') }}" class="the-hotro-nhanh">
                                <i class="bi bi-search"></i>
                                <div>
                                    <div class="fw-bold">Tra cứu đơn hàng</div>
                                    <div class="text-muted small">Kiểm tra trạng thái xử lý đơn hàng</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('cuahang.thongtin.chinh-sach-van-chuyen') }}" class="the-hotro-nhanh">
                                <i class="bi bi-truck"></i>
                                <div>
                                    <div class="fw-bold">Chính sách vận chuyển</div>
                                    <div class="text-muted small">Xem thông tin giao hàng</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('cuahang.thongtin.chinh-sach-doi-tra') }}" class="the-hotro-nhanh">
                                <i class="bi bi-arrow-repeat"></i>
                                <div>
                                    <div class="fw-bold">Chính sách đổi trả</div>
                                    <div class="text-muted small">Xem quy định hỗ trợ sau mua</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('cuahang.sanpham.index') }}" class="the-hotro-nhanh">
                                <i class="bi bi-box-seam"></i>
                                <div>
                                    <div class="fw-bold">Tiếp tục mua sắm</div>
                                    <div class="text-muted small">Quay lại danh sách sản phẩm</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="alert alert-primary mt-4 mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Khi liên hệ hỗ trợ đơn hàng, bạn nên cung cấp mã đơn hàng và số điện thoại đã đặt hàng.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

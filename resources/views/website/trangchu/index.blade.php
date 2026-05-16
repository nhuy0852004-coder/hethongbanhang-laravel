@extends('website.layouts.ungdung')

@section('tieude', 'Trang chủ')

@section('noidung')
    <section class="container py-4">
        <div class="website-hero">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Mua sắm dễ dàng, quản lý đơn hàng rõ ràng</h1>
                    <p class="mt-3">
                        Cửa hàng trực tuyến chuyên nghiệp, hiển thị sản phẩm rõ ràng,
                        giá tiền Việt Nam Đồng và trải nghiệm mua hàng đơn giản.
                    </p>

                    <div class="mt-4">
                        <a href="#" class="btn btn-primary px-4 py-2">
                            Xem sản phẩm
                        </a>
                        <a href="#" class="btn btn-light border px-4 py-2 ms-2">
                            Khuyến mãi hôm nay
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="bg-white border rounded-4 p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                 style="width: 46px; height: 46px;">
                                <i class="bi bi-bag-check fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Đơn hàng realtime</div>
                                <div class="text-muted small">Admin nhận thông báo ngay khi khách đặt hàng</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                                 style="width: 46px; height: 46px;">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Quản lý tồn kho</div>
                                <div class="text-muted small">Số lượng sản phẩm được cập nhật thực tế</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
            <h2 class="h4 fw-bold mb-0">Sản phẩm mới</h2>
            <a href="#" class="text-decoration-none">Xem tất cả</a>
        </div>

        <div class="row g-3">
            @for ($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-md-6">
                    <div class="the-sanpham">
                        <div class="the-sanpham-img">
                            <i class="bi bi-image fs-1"></i>
                        </div>

                        <div class="the-sanpham-body">
                            <div class="the-sanpham-title">Sản phẩm mẫu {{ $i }}</div>
                            <div class="the-sanpham-price">120.000 ₫</div>

                            <button class="btn btn-sm btn-outline-primary w-100 mt-3">
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
@endsection
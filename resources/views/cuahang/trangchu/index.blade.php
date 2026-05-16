@extends('cuahang.layouts.ungdung')

@section('tieude', 'Trang chủ')

@section('noidung')
    <section class="container py-4">
        <div class="cuahang-hero">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="badge bg-primary-subtle text-primary border border-primary-subtle mb-3">
                        Cửa hàng trực tuyến chuyên nghiệp
                    </div>

                    <h1>Mua sắm dễ dàng, sản phẩm rõ ràng, giá đúng Việt Nam Đồng</h1>

                    <p class="mt-3">
                        Khám phá sản phẩm mới, chương trình khuyến mãi và đặt hàng nhanh chóng.
                        Admin sẽ nhận thông báo realtime khi khách đặt hàng ở các ngày sau.
                    </p>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-primary px-4 py-2">
                            Xem sản phẩm
                        </a>

                        <a href="#sanphamkhuyenmai" class="btn btn-light border px-4 py-2">
                            Khuyến mãi hôm nay
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="cuahang-hero-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="hero-icon">
                                <i class="bi bi-bag-check"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Sản phẩm rõ ràng</div>
                                <div class="text-muted small">Ảnh, giá, tồn kho và mô tả đầy đủ</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="hero-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Giá Việt Nam Đồng</div>
                                <div class="text-muted small">Hiển thị đúng định dạng 120.000 ₫</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="hero-icon">
                                <i class="bi bi-truck"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Đặt hàng đơn giản</div>
                                <div class="text-muted small">Giỏ hàng và thanh toán sẽ làm ở ngày 7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-5">
            <div class="cuahang-section-title">
                <div>
                    <h2>Danh mục nổi bật</h2>
                    <p>Chọn nhóm sản phẩm bạn muốn xem</p>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($danhsachDanhmucNoiBat as $danhmuc)
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="{{ route('cuahang.sanpham.index', ['danhmuc' => $danhmuc->duong_dan]) }}"
                           class="the-danhmuc-cuahang">
                            <div class="the-danhmuc-icon">
                                <i class="bi bi-grid"></i>
                            </div>

                            <div class="fw-semibold mt-2">{{ $danhmuc->ten_danh_muc }}</div>
                            <div class="text-muted small">{{ $danhmuc->sanpham_count }} sản phẩm</div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="trang-rong-cuahang">
                            Chưa có danh mục nổi bật.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mt-5">
            <div class="cuahang-section-title">
                <div>
                    <h2>Sản phẩm mới</h2>
                    <p>Những sản phẩm vừa được cập nhật trong cửa hàng</p>
                </div>

                <a href="{{ route('cuahang.sanpham.index') }}">Xem tất cả</a>
            </div>

            <div class="row g-3">
                @forelse ($danhsachSanphamMoi as $sanpham)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        @include('cuahang.components.thesanpham', ['sanpham' => $sanpham])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="trang-rong-cuahang">
                            Chưa có sản phẩm mới.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mt-5" id="sanphamkhuyenmai">
            <div class="cuahang-section-title">
                <div>
                    <h2>Sản phẩm khuyến mãi</h2>
                    <p>Giá tốt hơn cho khách hàng hôm nay</p>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($danhsachSanphamKhuyenMai as $sanpham)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        @include('cuahang.components.thesanpham', ['sanpham' => $sanpham])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="trang-rong-cuahang">
                            Chưa có sản phẩm khuyến mãi.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </section>
@endsection
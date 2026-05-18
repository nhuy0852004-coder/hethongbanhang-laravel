<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tieude', 'Cửa hàng')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="cuahang-body">
    <header class="cuahang-header">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('trangchu') }}" class="cuahang-logo">
                <i class="bi bi-shop me-2"></i>
                Bán Hàng Pro
            </a>

            <nav class="cuahang-nav d-none d-lg-flex align-items-center">
                <a href="{{ route('trangchu') }}" class="{{ request()->routeIs('trangchu') ? 'active' : '' }}">
                    Trang chủ
                </a>

                <a href="{{ route('cuahang.sanpham.index') }}" class="{{ request()->routeIs('cuahang.sanpham.*') ? 'active' : '' }}">
                    Sản phẩm
                </a>

                <a href="{{ route('cuahang.donhang.tracuu') }}" class="{{ request()->routeIs('cuahang.donhang.*') ? 'active' : '' }}">
                    Tra cứu đơn hàng
                </a>

                <a href="{{ route('cuahang.giohang.index') }}" class="{{ request()->routeIs('cuahang.giohang.*') ? 'active' : '' }}">
                    Giỏ hàng
                </a>

                <a href="#">
                    Khuyến mãi
                </a>

                <a href="#">
                    Liên hệ
                </a>
            </nav>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('quantri.bangdieukhien') }}" class="btn btn-light border d-none d-md-inline-flex">
                    Quản trị
                </a>

                <a href="{{ route('cuahang.giohang.index') }}" class="btn btn-primary position-relative">
                    <i class="bi bi-cart3 me-1"></i>
                    Giỏ hàng

                    @if (dem_gio_hang() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ dinh_dang_so_luong(dem_gio_hang()) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('noidung')
    </main>

    <footer class="cuahang-footer mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="fw-bold fs-5 mb-2">Bán Hàng Pro</div>
                    <p class="text-muted mb-0">
                        Cửa hàng trực tuyến chuyên nghiệp, sản phẩm rõ ràng,
                        giá Việt Nam Đồng và trải nghiệm mua hàng dễ sử dụng.
                    </p>
                </div>

                <div class="col-lg-3">
                    <div class="fw-semibold mb-2">Danh mục</div>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('cuahang.sanpham.index') }}">Tất cả sản phẩm</a>
                        <a href="#">Sản phẩm mới</a>
                        <a href="#">Khuyến mãi</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="fw-semibold mb-2">Liên hệ</div>
                    <div class="text-muted">Số điện thoại: 0900 000 000</div>
                    <div class="text-muted">Email: hotro@banhangpro.vn</div>
                    <div class="text-muted">Địa chỉ: Việt Nam</div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
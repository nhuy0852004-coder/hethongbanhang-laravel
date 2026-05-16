<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tieude', 'Cửa hàng')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="website-body">
    <header class="website-header">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('trangchu') }}" class="website-logo">
                Bán Hàng Pro
            </a>

            <nav class="website-nav d-none d-md-flex align-items-center">
                <a href="{{ route('trangchu') }}">Trang chủ</a>
                <a href="#">Sản phẩm</a>
                <a href="#">Khuyến mãi</a>
                <a href="#">Liên hệ</a>
            </nav>

            <a href="#" class="btn btn-outline-primary">
                <i class="bi bi-cart3 me-1"></i>
                Giỏ hàng
            </a>
        </div>
    </header>

    <main>
        @yield('noidung')
    </main>
</body>
</html>
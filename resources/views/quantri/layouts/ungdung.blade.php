<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tieude', 'Quản trị bán hàng')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="quantri-wrapper">
        @include('quantri.layouts.thanhben')

        <main class="quantri-main">
            @include('quantri.layouts.thanhtren')

            <div class="quantri-content">
                @yield('noidung')
            </div>
        </main>
    </div>

    @include('components.thongbaotoast')
    
    @stack('scripts')
</body>
</html>
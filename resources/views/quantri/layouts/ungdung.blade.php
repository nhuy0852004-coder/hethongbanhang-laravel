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

    @auth
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (!window.Echo) {
                    return;
                }

                window.Echo.private('quantri.thongbao')
                    .listen('.donhang.moi', function (suKien) {
                        capNhatChuongThongbao(suKien);
                        hienToastDonhangMoi(suKien);
                    });

                function capNhatChuongThongbao(suKien) {
                    const badge = document.getElementById('soLuongThongbaoChuaDoc');
                    const danhSach = document.getElementById('danhsachThongbaoHeader');
                    const thongbaoRong = document.getElementById('thongbaoHeaderRong');

                    if (badge) {
                        let hienTai = parseInt(badge.textContent || '0');
                        let moi = hienTai + 1;

                        badge.textContent = moi;
                        badge.classList.remove('d-none');
                    }

                    if (thongbaoRong) {
                        thongbaoRong.remove();
                    }

                    if (danhSach) {
                        const item = document.createElement('a');
                        item.href = suKien.duong_dan;
                        item.className = 'thongbao-header-item chua-doc';
                        item.innerHTML = `
                            <div class="fw-semibold">${suKien.tieu_de}</div>
                            <div class="text-muted small">${suKien.noi_dung}</div>
                            <div class="text-muted small mt-1">${suKien.thoi_gian}</div>
                        `;

                        danhSach.prepend(item);
                    }
                }

                function hienToastDonhangMoi(suKien) {
                    const containerId = 'realtimeToastContainer';
                    let container = document.getElementById(containerId);

                    if (!container) {
                        container = document.createElement('div');
                        container.id = containerId;
                        container.className = 'toast-container position-fixed top-0 end-0 p-3';
                        container.style.zIndex = '2000';
                        document.body.appendChild(container);
                    }

                    const toastEl = document.createElement('div');
                    toastEl.className = 'toast border-0 shadow-sm';
                    toastEl.innerHTML = `
                        <div class="toast-header">
                            <i class="bi bi-receipt text-primary me-2"></i>
                            <strong class="me-auto">${suKien.tieu_de}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            <div class="fw-semibold">${suKien.ma_don_hang}</div>
                            <div class="text-muted small">${suKien.khach_hang}</div>
                            <div class="fw-bold text-danger mt-1">${suKien.tong_thanh_toan}</div>
                            <a href="${suKien.duong_dan}" class="btn btn-sm btn-primary mt-2">
                                Xem đơn hàng
                            </a>
                        </div>
                    `;

                    container.appendChild(toastEl);

                    const toast = new bootstrap.Toast(toastEl, {
                        delay: 6000,
                    });

                    toast.show();

                    toastEl.addEventListener('hidden.bs.toast', function () {
                        toastEl.remove();
                    });
                }
            });
        </script>
    @endauth
</body>
</html>
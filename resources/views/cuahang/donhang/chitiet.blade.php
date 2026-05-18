@extends('cuahang.layouts.ungdung')

@section('tieude', 'Chi tiết đơn hàng')

@section('noidung')
    <section class="container py-4">
        <div class="cuahang-page-title">
            <div>
                <h1>Chi tiết đơn hàng</h1>
                <p>Theo dõi trạng thái xử lý đơn hàng của bạn</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="donhang-khach-card mb-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <div class="text-muted small">Mã đơn hàng</div>
                            <div class="fw-bold fs-5 text-primary">{{ $donhang->ma_don_hang }}</div>
                        </div>

                        <div>
                            <span id="badgeTrangthaiDonhang"
                                  class="badge-trangthai {{ class_trang_thai_don_hang($donhang->trang_thai) }}">
                                {{ ten_trang_thai_don_hang($donhang->trang_thai) }}
                            </span>
                        </div>
                    </div>

                    <div class="text-muted small mt-3">
                        Cập nhật gần nhất:
                        <span id="thoigianCapnhatTrangthai">
                            {{ dinh_dang_ngay_gio($donhang->updated_at) }}
                        </span>
                    </div>
                </div>

                <div class="donhang-khach-card">
                    <div class="fw-bold mb-3">Sản phẩm đã đặt</div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th style="width: 120px;">Số lượng</th>
                                    <th style="width: 160px;">Thành tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($donhang->chitietdonhang as $chitiet)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="giohang-anh">
                                                    @if ($chitiet->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $chitiet->anh_san_pham) }}"
                                                             alt="{{ $chitiet->ten_san_pham }}">
                                                    @else
                                                        <i class="bi bi-image text-muted"></i>
                                                    @endif
                                                </div>

                                                <div>
                                                    <div class="fw-semibold">{{ $chitiet->ten_san_pham }}</div>
                                                    <div class="text-muted small">
                                                        Đơn giá: {{ dinh_dang_tien($chitiet->gia_ban) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $chitiet->so_luong }}
                                        </td>

                                        <td>
                                            <div class="fw-bold text-danger">
                                                {{ dinh_dang_tien($chitiet->thanh_tien) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="donhang-khach-card mb-4">
                    <div class="fw-bold mb-3">Thông tin nhận hàng</div>

                    <div class="mb-2">
                        <div class="text-muted small">Người nhận</div>
                        <div class="fw-semibold">{{ $donhang->ho_ten_nguoi_nhan }}</div>
                    </div>

                    <div class="mb-2">
                        <div class="text-muted small">Số điện thoại</div>
                        <div class="fw-semibold">{{ $donhang->so_dien_thoai }}</div>
                    </div>

                    <div>
                        <div class="text-muted small">Địa chỉ</div>
                        <div class="fw-semibold">
                            {{ $donhang->dia_chi }},
                            {{ $donhang->phuong_xa }},
                            {{ $donhang->quan_huyen }},
                            {{ $donhang->tinh_thanh }}
                        </div>
                    </div>
                </div>

                <div class="donhang-khach-card">
                    <div class="fw-bold mb-3">Thanh toán</div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tiền hàng</span>
                        <span class="fw-semibold">{{ dinh_dang_tien($donhang->tong_tien_hang) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Phí vận chuyển</span>
                        <span class="fw-semibold">{{ dinh_dang_tien($donhang->phi_van_chuyen) }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Tổng cộng</span>
                        <span class="giohang-tongtien">
                            {{ dinh_dang_tien($donhang->tong_thanh_toan) }}
                        </span>
                    </div>

                    <a href="{{ route('cuahang.donhang.tracuu') }}" class="btn btn-light border w-100 mt-4">
                        Tra cứu đơn khác
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.Echo) {
                return;
            }

            const maDonHang = @json($donhang->ma_don_hang);

            window.Echo.channel('donhang.' + maDonHang)
                .listen('.trangthai.capnhat', function (suKien) {
                    const badge = document.getElementById('badgeTrangthaiDonhang');
                    const thoiGian = document.getElementById('thoigianCapnhatTrangthai');

                    if (badge) {
                        badge.className = 'badge-trangthai ' + suKien.class_trang_thai;
                        badge.textContent = suKien.ten_trang_thai;
                    }

                    if (thoiGian) {
                        thoiGian.textContent = suKien.thoi_gian;
                    }

                    hienToastTrangThai(suKien);
                });

            function hienToastTrangThai(suKien) {
                let container = document.getElementById('realtimeToastContainer');

                if (!container) {
                    container = document.createElement('div');
                    container.id = 'realtimeToastContainer';
                    container.className = 'toast-container position-fixed top-0 end-0 p-3';
                    container.style.zIndex = '2000';
                    document.body.appendChild(container);
                }

                const toastEl = document.createElement('div');
                toastEl.className = 'toast border-0 shadow-sm';
                toastEl.innerHTML = `
                    <div class="toast-header">
                        <i class="bi bi-truck text-primary me-2"></i>
                        <strong class="me-auto">Đơn hàng đã cập nhật</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>

                    <div class="toast-body">
                        <div>Mã đơn: <strong>${suKien.ma_don_hang}</strong></div>
                        <div>Trạng thái mới: <strong>${suKien.ten_trang_thai}</strong></div>
                        <div class="text-muted small mt-1">${suKien.thoi_gian}</div>
                    </div>
                `;

                container.appendChild(toastEl);

                const toast = new bootstrap.Toast(toastEl, {
                    delay: 5000,
                });

                toast.show();

                toastEl.addEventListener('hidden.bs.toast', function () {
                    toastEl.remove();
                });
            }
        });
    </script>
@endpush

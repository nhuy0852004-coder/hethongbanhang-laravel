@extends('quantri.layouts.ungdung')

@section('tieude', 'Bảng điều khiển')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Bảng điều khiển</h1>
            <p>Tổng quan hoạt động bán hàng hôm nay</p>
        </div>

        <a href="{{ route('quantri.baocao.doanhthu') }}" class="btn btn-chinh">
            <i class="bi bi-bar-chart me-1"></i>
            Xem báo cáo
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="the-thongke d-flex justify-content-between align-items-start">
                <div>
                    <div class="the-thongke-label">Doanh thu hôm nay</div>
                    <div class="the-thongke-value">{{ dinh_dang_tien($tongDoanhThuHomNay) }}</div>
                </div>
                <div class="the-thongke-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke d-flex justify-content-between align-items-start">
                <div>
                    <div class="the-thongke-label">Đơn hàng hôm nay</div>
                    <div class="the-thongke-value">{{ $tongDonHangHomNay }}</div>
                </div>
                <div class="the-thongke-icon">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke d-flex justify-content-between align-items-start">
                <div>
                    <div class="the-thongke-label">Tổng sản phẩm</div>
                    <div class="the-thongke-value">{{ $tongSanPham }}</div>
                </div>
                <div class="the-thongke-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke d-flex justify-content-between align-items-start">
                <div>
                    <div class="the-thongke-label">Tổng khách hàng</div>
                    <div class="the-thongke-value">{{ $tongKhachHang }}</div>
                </div>
                <div class="the-thongke-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="khoi-noidung">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="khoi-noidung-title mb-0">Doanh thu 7 ngày gần nhất</div>
                    <div class="text-muted small">Chỉ tính đơn hàng hoàn thành</div>
                </div>

                <div style="height: 300px;">
                    <canvas id="bieuDoDoanhThu7Ngay"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="khoi-noidung">
                <div class="khoi-noidung-title">Sản phẩm sắp hết hàng</div>

                @forelse ($danhsachSanphamSapHetHang as $sanpham)
                    <div class="dashboard-list-item">
                        <div class="d-flex align-items-center gap-3">
                            <div class="anh-sanpham-nho">
                                @if ($sanpham->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                                         alt="{{ $sanpham->ten_san_pham }}">
                                @else
                                    <i class="bi bi-image text-muted"></i>
                                @endif
                            </div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark">
                                    {{ $sanpham->ten_san_pham }}
                                </div>
                                <div class="text-muted small">
                                    {{ $sanpham->danhmuc->ten_danh_muc ?? 'Chưa có danh mục' }}
                                </div>
                            </div>

                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                {{ $sanpham->so_luong_ton }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        Chưa có sản phẩm sắp hết hàng
                    </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-12">
            <div class="khoi-noidung">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="khoi-noidung-title mb-1">Đơn hàng mới nhất</div>
                        <div class="text-muted small">Các đơn hàng vừa phát sinh gần đây</div>
                    </div>

                    <a href="{{ route('quantri.donhang.index') }}" class="btn btn-light border">
                        Xem tất cả
                    </a>
                </div>

                @if ($danhsachDonhangMoiNhat->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle bang-quantri">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Thời gian</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Chi tiết</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($danhsachDonhangMoiNhat as $donhang)
                                    <tr>
                                        <td class="fw-bold text-primary">
                                            {{ $donhang->ma_don_hang }}
                                        </td>

                                        <td>
                                            <div class="fw-semibold">{{ $donhang->ho_ten_nguoi_nhan }}</div>
                                            <div class="text-muted small">{{ $donhang->so_dien_thoai }}</div>
                                        </td>

                                        <td>
                                            <div>{{ dinh_dang_ngay($donhang->created_at) }}</div>
                                            <div class="text-muted small">{{ dinh_dang_gio($donhang->created_at) }}</div>
                                        </td>

                                        <td class="fw-bold text-danger">
                                            {{ dinh_dang_tien($donhang->tong_thanh_toan) }}
                                        </td>

                                        <td>
                                            <span class="badge-trangthai {{ class_trang_thai_don_hang($donhang->trang_thai) }}">
                                                {{ ten_trang_thai_don_hang($donhang->trang_thai) }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <a href="{{ route('quantri.donhang.show', $donhang) }}"
                                               class="btn btn-sm btn-light border">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="trang-rong">
                        <div class="trang-rong-icon">
                            <i class="bi bi-receipt"></i>
                        </div>

                        <div class="fw-bold mt-3">Chưa có đơn hàng</div>
                        <div class="text-muted mt-1">Đơn hàng mới sẽ hiển thị tại đây.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('bieuDoDoanhThu7Ngay');

            if (!canvas || !window.Chart) {
                return;
            }

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: @json($bieuDoDoanhThu7Ngay['labels']),
                    datasets: [{
                        label: 'Doanh thu',
                        data: @json($bieuDoDoanhThu7Ngay['values']),
                        tension: 0.35,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return new Intl.NumberFormat('vi-VN').format(context.raw) + ' ₫';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: function (value) {
                                    return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush

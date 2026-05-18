@extends('quantri.layouts.ungdung')

@section('tieude', 'Báo cáo doanh thu')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Báo cáo doanh thu</h1>
            <p>Theo dõi doanh thu, đơn hàng hoàn thành và sản phẩm bán chạy</p>
        </div>
    </div>

    <div class="khoi-noidung mb-3">
        <form action="{{ route('quantri.baocao.doanhthu') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Từ ngày</label>
                <input type="date"
                       name="tu_ngay"
                       value="{{ $boLoc['tu_ngay'] }}"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Đến ngày</label>
                <input type="date"
                       name="den_ngay"
                       value="{{ $boLoc['den_ngay'] }}"
                       class="form-control">
            </div>

            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-funnel me-1"></i>
                    Xem báo cáo
                </button>

                <a href="{{ route('quantri.baocao.doanhthu') }}" class="btn btn-light border">
                    Tháng hiện tại
                </a>
            </div>
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Tổng doanh thu</div>
                <div class="the-thongke-value text-danger">
                    {{ dinh_dang_tien($thongKe['tong_doanh_thu']) }}
                </div>
                <div class="text-muted small mt-2">Chỉ tính đơn hoàn thành</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Tổng đơn phát sinh</div>
                <div class="the-thongke-value">
                    {{ $thongKe['tong_don_moi'] }}
                </div>
                <div class="text-muted small mt-2">Tất cả trạng thái</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Đơn hoàn thành</div>
                <div class="the-thongke-value">
                    {{ $thongKe['tong_don_hoan_thanh'] }}
                </div>
                <div class="text-muted small mt-2">Được tính vào doanh thu</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="the-thongke">
                <div class="the-thongke-label">Đơn đã hủy</div>
                <div class="the-thongke-value">
                    {{ $thongKe['tong_don_da_huy'] }}
                </div>
                <div class="text-muted small mt-2">Không tính doanh thu</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="khoi-noidung">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="khoi-noidung-title mb-1">Biểu đồ doanh thu</div>
                        <div class="text-muted small">
                            Từ {{ \Carbon\Carbon::parse($boLoc['tu_ngay'])->format('d/m/Y') }}
                            đến {{ \Carbon\Carbon::parse($boLoc['den_ngay'])->format('d/m/Y') }}
                        </div>
                    </div>
                </div>

                <div style="height: 340px;">
                    <canvas id="bieuDoBaoCaoDoanhThu"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="khoi-noidung">
                <div class="khoi-noidung-title">Top sản phẩm bán chạy</div>

                @forelse ($danhsachTopSanpham as $index => $sanpham)
                    <div class="top-sanpham-item">
                        <div class="top-sanpham-rank">
                            {{ $index + 1 }}
                        </div>

                        <div class="flex-grow-1">
                            <div class="fw-semibold">
                                {{ $sanpham->ten_san_pham }}
                            </div>

                            <div class="text-muted small">
                                Bán {{ $sanpham->tong_so_luong }} sản phẩm
                            </div>
                        </div>

                        <div class="fw-bold text-danger">
                            {{ dinh_dang_tien($sanpham->tong_doanh_thu) }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        Chưa có sản phẩm bán chạy trong khoảng ngày này.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('bieuDoBaoCaoDoanhThu');

            if (!canvas || !window.Chart) {
                return;
            }

            new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: @json($bieuDoDoanhThu['labels']),
                    datasets: [{
                        label: 'Doanh thu',
                        data: @json($bieuDoDoanhThu['values']),
                        borderWidth: 1,
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

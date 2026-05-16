@extends('quantri.layouts.ungdung')

@section('tieude', 'Bảng điều khiển')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Bảng điều khiển</h1>
            <p>Tổng quan hoạt động bán hàng hôm nay</p>
        </div>

        <!-- <button class="btn btn-chinh">
            <i class="bi bi-plus-lg me-1"></i>
            Tạo đơn hàng
        </button> -->
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="the-thongke d-flex justify-content-between align-items-start">
                <div>
                    <div class="the-thongke-label">Doanh thu hôm nay</div>
                    <div class="the-thongke-value">0 ₫</div>
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
                    <div class="the-thongke-value">0</div>
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
                    <div class="the-thongke-value">0</div>
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
                    <div class="the-thongke-value">0</div>
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
                <div class="khoi-noidung-title">Doanh thu 7 ngày gần nhất</div>

                <div class="d-flex align-items-center justify-content-center text-muted"
                     style="height: 260px; border: 1px dashed #E5E7EB; border-radius: 10px;">
                    Biểu đồ doanh thu sẽ được thêm ở ngày báo cáo
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="khoi-noidung">
                <div class="khoi-noidung-title">Thông báo mới</div>

                <div class="text-center py-5">
                    <i class="bi bi-bell text-muted" style="font-size: 38px;"></i>
                    <div class="fw-semibold mt-3">Chưa có thông báo</div>
                    <div class="text-muted small">Thông báo đơn hàng mới sẽ hiển thị tại đây</div>
                </div>
            </div>
        </div>
    </div>
@endsection
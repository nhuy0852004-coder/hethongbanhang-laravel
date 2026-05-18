@extends('cuahang.layouts.ungdung')

@section('tieude', 'Chính sách vận chuyển')

@section('noidung')
    <section class="container py-4">
        <div class="trang-thongtin-hero">
            <div class="trang-thongtin-icon">
                <i class="bi bi-truck"></i>
            </div>

            <div>
                <h1>Chính sách vận chuyển</h1>
                <p>Thông tin về thời gian giao hàng, phạm vi giao hàng và quy định vận chuyển của cửa hàng.</p>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <div class="trang-thongtin-card">
                    <h2>Nội dung chính sách</h2>

                    @if (!empty($caidat?->chinh_sach_van_chuyen))
                        <div class="noi-dung-chinh-sach">
                            {!! nl2br(e($caidat->chinh_sach_van_chuyen)) !!}
                        </div>
                    @else
                        <div class="noi-dung-chinh-sach">
                            Cửa hàng hỗ trợ giao hàng toàn quốc. Thời gian giao hàng tùy theo khu vực nhận hàng.
                            Nhân viên cửa hàng sẽ liên hệ xác nhận thông tin trước khi giao hàng.
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="trang-thongtin-card">
                    <h2>Thông tin cửa hàng</h2>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-shop"></i>
                        <div>
                            <div class="text-muted small">Cửa hàng</div>
                            <div class="fw-semibold">{{ $caidat->ten_cua_hang ?? 'Bán Hàng Pro' }}</div>
                        </div>
                    </div>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <div class="text-muted small">Số điện thoại</div>
                            <div class="fw-semibold">{{ $caidat->so_dien_thoai ?? 'Đang cập nhật' }}</div>
                        </div>
                    </div>

                    <div class="thongtin-lienhe-item">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $caidat->email ?? 'Đang cập nhật' }}</div>
                        </div>
                    </div>

                    <a href="{{ route('cuahang.thongtin.lien-he') }}" class="btn btn-primary w-100 mt-3">
                        Liên hệ cửa hàng
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

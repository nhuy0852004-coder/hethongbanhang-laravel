@extends('cuahang.layouts.ungdung')

@section('tieude', 'Chính sách đổi trả')

@section('noidung')
    <section class="container py-4">
        <div class="trang-thongtin-hero">
            <div class="trang-thongtin-icon">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div>
                <h1>Chính sách đổi trả</h1>
                <p>Quy định hỗ trợ đổi trả sản phẩm, xử lý sản phẩm lỗi và các trường hợp cần hỗ trợ sau mua hàng.</p>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <div class="trang-thongtin-card">
                    <h2>Nội dung chính sách</h2>

                    @if (!empty($caidat?->chinh_sach_doi_tra))
                        <div class="noi-dung-chinh-sach">
                            {!! nl2br(e($caidat->chinh_sach_doi_tra)) !!}
                        </div>
                    @else
                        <div class="noi-dung-chinh-sach">
                            Khách hàng được hỗ trợ đổi trả nếu sản phẩm bị lỗi, không đúng mô tả hoặc phát sinh vấn đề
                            trong quá trình vận chuyển. Vui lòng liên hệ cửa hàng để được hỗ trợ chi tiết.
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="trang-thongtin-card">
                    <h2>Cần hỗ trợ?</h2>

                    <p class="text-muted">
                        Nếu đơn hàng của bạn cần đổi trả, hãy chuẩn bị mã đơn hàng và liên hệ cửa hàng để được kiểm tra nhanh hơn.
                    </p>

                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('cuahang.donhang.tracuu') }}" class="btn btn-light border">
                            Tra cứu đơn hàng
                        </a>

                        <a href="{{ route('cuahang.thongtin.lien-he') }}" class="btn btn-primary">
                            Liên hệ hỗ trợ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('cuahang.layouts.ungdung')

@section('tieude', 'Sản phẩm')

@section('noidung')
    <section class="container py-4">
        <div class="cuahang-page-title">
            <div>
                <h1>Sản phẩm</h1>
                <p>Tìm kiếm, lọc và chọn sản phẩm phù hợp với nhu cầu của bạn</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <form action="{{ route('cuahang.sanpham.index') }}" method="GET" class="boloc-cuahang">
                    <div class="fw-bold mb-3">Bộ lọc sản phẩm</div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tìm kiếm</label>
                        <input type="text"
                               name="tu_khoa"
                               value="{{ $boLoc['tu_khoa'] ?? '' }}"
                               class="form-control"
                               placeholder="Nhập tên sản phẩm...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <select name="danhmuc" class="form-select">
                            <option value="">Tất cả danh mục</option>

                            @foreach ($danhsachDanhmuc as $danhmuc)
                                <option value="{{ $danhmuc->duong_dan }}" @selected(($boLoc['danhmuc'] ?? '') === $danhmuc->duong_dan)>
                                    {{ $danhmuc->ten_danh_muc }} ({{ $danhmuc->sanpham_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Giá từ</label>
                            <input type="text"
                                   name="gia_tu"
                                   value="{{ $boLoc['gia_tu'] ? number_format($boLoc['gia_tu'], 0, ',', '.') : '' }}"
                                   class="form-control nhap-tien-vnd"
                                   placeholder="0">
                        </div>

                        <div class="col-6">
                            <label class="form-label fw-semibold">Giá đến</label>
                            <input type="text"
                                   name="gia_den"
                                   value="{{ $boLoc['gia_den'] ? number_format($boLoc['gia_den'], 0, ',', '.') : '' }}"
                                   class="form-control nhap-tien-vnd"
                                   placeholder="1.000.000">
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label fw-semibold">Sắp xếp</label>
                        <select name="sap_xep" class="form-select">
                            <option value="moi_nhat" @selected(($boLoc['sap_xep'] ?? '') === 'moi_nhat')>
                                Mới nhất
                            </option>
                            <option value="gia_thap" @selected(($boLoc['sap_xep'] ?? '') === 'gia_thap')>
                                Giá thấp đến cao
                            </option>
                            <option value="gia_cao" @selected(($boLoc['sap_xep'] ?? '') === 'gia_cao')>
                                Giá cao đến thấp
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-1"></i>
                        Áp dụng bộ lọc
                    </button>

                    <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-light border w-100 mt-2">
                        Làm mới
                    </a>
                </form>
            </div>

            <div class="col-lg-9">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="text-muted">
                        Tìm thấy <strong>{{ $danhsachSanpham->total() }}</strong> sản phẩm
                    </div>
                </div>

                @if ($danhsachSanpham->count() > 0)
                    <div class="row g-3">
                        @foreach ($danhsachSanpham as $sanpham)
                            <div class="col-xl-4 col-md-6">
                                @include('cuahang.components.thesanpham', ['sanpham' => $sanpham])
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $danhsachSanpham->links() }}
                    </div>
                @else
                    <div class="trang-rong-cuahang">
                        <i class="bi bi-search fs-1 text-muted"></i>
                        <div class="fw-bold mt-3">Không tìm thấy sản phẩm phù hợp</div>
                        <div class="text-muted mt-1">Bạn hãy thử thay đổi từ khóa hoặc bộ lọc.</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cacInputTien = document.querySelectorAll('.nhap-tien-vnd');

            cacInputTien.forEach(function (input) {
                input.addEventListener('input', function () {
                    let giaTri = this.value.replace(/[^0-9]/g, '');

                    if (!giaTri) {
                        this.value = '';
                        return;
                    }

                    this.value = Number(giaTri).toLocaleString('vi-VN');
                });
            });
        });
    </script>
@endpush
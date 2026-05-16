@extends('cuahang.layouts.ungdung')

@section('tieude', $sanpham->ten_san_pham)

@section('noidung')
    <section class="container py-4">
        <nav class="mb-3 small">
            <a href="{{ route('trangchu') }}" class="text-decoration-none">Trang chủ</a>
            <span class="text-muted mx-1">/</span>
            <a href="{{ route('cuahang.sanpham.index') }}" class="text-decoration-none">Sản phẩm</a>
            <span class="text-muted mx-1">/</span>
            <span class="text-muted">{{ $sanpham->ten_san_pham }}</span>
        </nav>

        <div class="chitiet-sanpham">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="chitiet-sanpham-anh">
                        @if ($sanpham->anh_dai_dien)
                            <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="{{ $sanpham->ten_san_pham }}">
                        @else
                            <div class="chitiet-sanpham-anh-rong">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="text-muted mb-2">
                        {{ $sanpham->danhmuc->ten_danh_muc ?? 'Chưa phân loại' }}
                    </div>

                    <h1 class="chitiet-sanpham-ten">
                        {{ $sanpham->ten_san_pham }}
                    </h1>

                    <div class="text-muted mt-2">
                        Mã sản phẩm: <strong>{{ $sanpham->ma_san_pham }}</strong>
                    </div>

                    <div class="mt-4">
                        @if ($sanpham->gia_khuyen_mai)
                            <div class="chitiet-gia-khuyen-mai">
                                {{ dinh_dang_tien($sanpham->gia_khuyen_mai) }}
                            </div>

                            <div class="chitiet-gia-goc">
                                {{ dinh_dang_tien($sanpham->gia_ban) }}
                            </div>
                        @else
                            <div class="chitiet-gia-khuyen-mai">
                                {{ dinh_dang_tien($sanpham->gia_ban) }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if ($sanpham->so_luong_ton > 0)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                Còn {{ $sanpham->so_luong_ton }} sản phẩm
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                Hết hàng
                            </span>
                        @endif
                    </div>

                    @if ($sanpham->mo_ta_ngan)
                        <p class="mt-4 text-muted">
                            {{ $sanpham->mo_ta_ngan }}
                        </p>
                    @endif

                    <div class="mt-4">
                        @if ($sanpham->so_luong_ton > 0)
                            <form action="{{ route('cuahang.giohang.them', $sanpham) }}" method="POST" class="d-flex gap-2 flex-wrap">
                                @csrf

                                <input type="number"
                                       name="so_luong"
                                       value="1"
                                       min="1"
                                       max="{{ $sanpham->so_luong_ton }}"
                                       class="form-control"
                                       style="width: 110px;">

                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="bi bi-cart-plus me-1"></i>
                                    Thêm vào giỏ hàng
                                </button>

                                <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-light border px-4 py-2">
                                    Tiếp tục mua sắm
                                </a>
                            </form>
                        @else
                            <button class="btn btn-light border px-4 py-2" disabled>
                                Sản phẩm đã hết hàng
                            </button>
                        @endif
                    </div>

                    <div class="cuahang-ghichu mt-4">
                        <div>
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Giá hiển thị theo Việt Nam Đồng
                        </div>
                        <div>
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Số lượng tồn kho được cập nhật từ admin
                        </div>
                        <div>
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Giỏ hàng và đặt hàng sẽ hoàn thiện ở ngày 7
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($sanpham->mo_ta_chi_tiet)
            <div class="khoi-mota-sanpham mt-4">
                <h2>Mô tả sản phẩm</h2>

                <div class="text-muted lh-lg">
                    {!! nl2br(e($sanpham->mo_ta_chi_tiet)) !!}
                </div>
            </div>
        @endif

        <section class="mt-5">
            <div class="cuahang-section-title">
                <div>
                    <h2>Sản phẩm liên quan</h2>
                    <p>Các sản phẩm cùng danh mục có thể bạn quan tâm</p>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($danhsachSanphamLienQuan as $sanphamLienQuan)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        @include('cuahang.components.thesanpham', ['sanpham' => $sanphamLienQuan])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="trang-rong-cuahang">
                            Chưa có sản phẩm liên quan.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </section>
@endsection
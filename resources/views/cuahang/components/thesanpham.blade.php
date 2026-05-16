<div class="the-sanpham-cuahang">
    <a href="{{ route('cuahang.sanpham.show', $sanpham->duong_dan) }}" class="the-sanpham-anh">
        @if ($sanpham->anh_dai_dien)
            <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="{{ $sanpham->ten_san_pham }}">
        @else
            <div class="the-sanpham-anh-rong">
                <i class="bi bi-image"></i>
            </div>
        @endif

        @if ($sanpham->gia_khuyen_mai)
            <span class="nhan-khuyen-mai">Khuyến mãi</span>
        @endif
    </a>

    <div class="the-sanpham-noidung">
        <div class="text-muted small mb-1">
            {{ $sanpham->danhmuc->ten_danh_muc ?? 'Chưa phân loại' }}
        </div>

        <a href="{{ route('cuahang.sanpham.show', $sanpham->duong_dan) }}" class="the-sanpham-ten">
            {{ $sanpham->ten_san_pham }}
        </a>

        <div class="mt-2">
            @if ($sanpham->gia_khuyen_mai)
                <span class="gia-khuyen-mai">{{ dinh_dang_tien($sanpham->gia_khuyen_mai) }}</span>
                <span class="gia-goc">{{ dinh_dang_tien($sanpham->gia_ban) }}</span>
            @else
                <span class="gia-khuyen-mai">{{ dinh_dang_tien($sanpham->gia_ban) }}</span>
            @endif
        </div>

        <div class="mt-3">
            @if ($sanpham->so_luong_ton > 0)
                <form action="{{ route('cuahang.giohang.them', $sanpham) }}" method="POST">
                    @csrf
                    <input type="hidden" name="so_luong" value="1">

                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-cart-plus me-1"></i>
                        Thêm vào giỏ
                    </button>
                </form>
            @else
                <button class="btn btn-light border w-100" disabled>
                    Hết hàng
                </button>
            @endif
        </div>
    </div>
</div>
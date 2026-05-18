@extends('cuahang.layouts.ungdung')

@section('tieude', 'Tra cứu đơn hàng')

@section('noidung')
    <section class="container py-5">
        <div class="tracuu-wrapper">
            <div class="text-center mb-4">
                <div class="tracuu-icon">
                    <i class="bi bi-search"></i>
                </div>

                <h1 class="mt-3">Tra cứu đơn hàng</h1>
                <p class="text-muted">
                    Nhập mã đơn hàng và số điện thoại đã dùng khi đặt hàng để xem trạng thái xử lý.
                </p>
            </div>

            @if (session('loi'))
                <div class="alert alert-danger">{{ session('loi') }}</div>
            @endif

            <form action="{{ route('cuahang.donhang.xuly-tracuu') }}" method="POST" class="tracuu-card">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Mã đơn hàng <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="ma_don_hang"
                           value="{{ old('ma_don_hang') }}"
                           class="form-control @error('ma_don_hang') is-invalid @enderror"
                           placeholder="Ví dụ: DH260518123456789">

                    @error('ma_don_hang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Số điện thoại đặt hàng <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="so_dien_thoai"
                           value="{{ old('so_dien_thoai') }}"
                           class="form-control @error('so_dien_thoai') is-invalid @enderror"
                           placeholder="0900000000">

                    @error('so_dien_thoai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-search me-1"></i>
                    Tra cứu đơn hàng
                </button>
            </form>
        </div>
    </section>
@endsection

@extends('cuahang.layouts.ungdung')

@section('tieude', 'Thanh toán')

@section('noidung')
    <section class="container py-4">
        <div class="cuahang-page-title">
            <div>
                <h1>Thanh toán</h1>
                <p>Nhập thông tin nhận hàng để hoàn tất đơn hàng</p>
            </div>
        </div>

        @if (session('loi'))
            <div class="alert alert-danger">{{ session('loi') }}</div>
        @endif

        <form action="{{ route('cuahang.thanhtoan.dathang') }}" method="POST">
            @csrf

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="giohang-card">
                        <div class="fw-bold mb-3">Thông tin người nhận</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Họ tên người nhận <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="ho_ten_nguoi_nhan"
                                       value="{{ old('ho_ten_nguoi_nhan') }}"
                                       class="form-control @error('ho_ten_nguoi_nhan') is-invalid @enderror"
                                       placeholder="Nguyễn Văn A">

                                @error('ho_ten_nguoi_nhan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Số điện thoại <span class="text-danger">*</span>
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

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Email</label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="email@example.com">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Tỉnh/Thành <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="tinh_thanh"
                                       value="{{ old('tinh_thanh') }}"
                                       class="form-control @error('tinh_thanh') is-invalid @enderror"
                                       placeholder="TP. Hồ Chí Minh">

                                @error('tinh_thanh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Quận/Huyện <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="quan_huyen"
                                       value="{{ old('quan_huyen') }}"
                                       class="form-control @error('quan_huyen') is-invalid @enderror"
                                       placeholder="Quận 1">

                                @error('quan_huyen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Phường/Xã <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="phuong_xa"
                                       value="{{ old('phuong_xa') }}"
                                       class="form-control @error('phuong_xa') is-invalid @enderror"
                                       placeholder="Phường Bến Nghé">

                                @error('phuong_xa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">
                                    Địa chỉ cụ thể <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="dia_chi"
                                       value="{{ old('dia_chi') }}"
                                       class="form-control @error('dia_chi') is-invalid @enderror"
                                       placeholder="Số nhà, tên đường...">

                                @error('dia_chi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Ghi chú</label>

                                <textarea name="ghi_chu"
                                          rows="3"
                                          class="form-control @error('ghi_chu') is-invalid @enderror"
                                          placeholder="Ghi chú cho đơn hàng nếu có">{{ old('ghi_chu') }}</textarea>

                                @error('ghi_chu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="giohang-card mt-4">
                        <div class="fw-bold mb-3">Phương thức thanh toán</div>

                        <label class="thanhtoan-method">
                            <input type="radio"
                                   name="phuong_thuc_thanh_toan"
                                   value="cod"
                                   checked>
                            <div>
                                <div class="fw-semibold">Thanh toán khi nhận hàng</div>
                                <div class="text-muted small">Khách thanh toán tiền mặt khi nhận sản phẩm</div>
                            </div>
                        </label>

                        <label class="thanhtoan-method mt-2">
                            <input type="radio"
                                   name="phuong_thuc_thanh_toan"
                                   value="chuyen_khoan"
                                   @checked(old('phuong_thuc_thanh_toan') === 'chuyen_khoan')>
                            <div>
                                <div class="fw-semibold">Chuyển khoản ngân hàng</div>
                                <div class="text-muted small">Thông tin chuyển khoản sẽ được cửa hàng xác nhận sau</div>
                            </div>
                        </label>

                        @error('phuong_thuc_thanh_toan')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="giohang-card">
                        <div class="fw-bold mb-3">Đơn hàng của bạn</div>

                        @foreach ($gioHang as $item)
                            <div class="d-flex justify-content-between gap-3 mb-3">
                                <div>
                                    <div class="fw-semibold">{{ $item['ten_san_pham'] }}</div>
                                    <div class="text-muted small">
                                        {{ $item['so_luong'] }} x {{ dinh_dang_tien($item['gia_hien_tai']) }}
                                    </div>
                                </div>

                                <div class="fw-semibold text-end">
                                    {{ dinh_dang_tien($item['gia_hien_tai'] * $item['so_luong']) }}
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tạm tính</span>
                            <span class="fw-semibold">{{ dinh_dang_tien($tongTien) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Phí vận chuyển</span>
                            <span class="fw-semibold">0 ₫</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Tổng thanh toán</span>
                            <span class="giohang-tongtien">{{ dinh_dang_tien($tongTien) }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">
                            <i class="bi bi-check2-circle me-1"></i>
                            Đặt hàng
                        </button>

                        <a href="{{ route('cuahang.giohang.index') }}" class="btn btn-light border w-100 mt-2">
                            Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
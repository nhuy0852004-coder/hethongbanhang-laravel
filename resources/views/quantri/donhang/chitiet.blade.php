@extends('quantri.layouts.ungdung')

@section('tieude', 'Chi tiết đơn hàng')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Chi tiết đơn hàng</h1>
            <p>Mã đơn hàng {{ $donhang->ma_don_hang }}</p>
        </div>

        <a href="{{ route('quantri.donhang.index') }}" class="btn btn-light border">
            <i class="bi bi-arrow-left me-1"></i>
            Quay lại
        </a>
    </div>

    @if (session('thanhcong'))
        <div class="alert alert-success">{{ session('thanhcong') }}</div>
    @endif

    @if (session('loi'))
        <div class="alert alert-danger">{{ session('loi') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="khoi-noidung mb-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="khoi-noidung-title mb-1">Sản phẩm trong đơn</div>
                        <div class="text-muted small">
                            {{ $donhang->chitietdonhang->count() }} sản phẩm
                        </div>
                    </div>

                    <span class="badge-trangthai {{ class_trang_thai_don_hang($donhang->trang_thai) }}">
                        {{ ten_trang_thai_don_hang($donhang->trang_thai) }}
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle bang-quantri">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th style="width: 140px;">Đơn giá</th>
                                <th style="width: 100px;">Số lượng</th>
                                <th style="width: 150px;">Thành tiền</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($donhang->chitietdonhang as $chitiet)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="anh-sanpham-nho">
                                                @if ($chitiet->anh_san_pham)
                                                    <img src="{{ asset('storage/' . $chitiet->anh_san_pham) }}"
                                                         alt="{{ $chitiet->ten_san_pham }}">
                                                @else
                                                    <i class="bi bi-image text-muted"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <div class="fw-semibold text-dark">
                                                    {{ $chitiet->ten_san_pham }}
                                                </div>

                                                @if ($chitiet->sanpham)
                                                    <div class="text-muted small">
                                                        Mã: {{ $chitiet->sanpham->ma_san_pham }}
                                                    </div>
                                                @else
                                                    <div class="text-muted small">
                                                        Sản phẩm đã bị xóa khỏi kho
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {{ dinh_dang_tien($chitiet->gia_ban) }}
                                    </td>

                                    <td>
                                        {{ $chitiet->so_luong }}
                                    </td>

                                    <td>
                                        <div class="fw-bold text-danger">
                                            {{ dinh_dang_tien($chitiet->thanh_tien) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="khoi-noidung">
                <div class="khoi-noidung-title">Thông tin nhận hàng</div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <div class="thongtin-donhang-item">
                            <div class="text-muted small">Người nhận</div>
                            <div class="fw-semibold">{{ $donhang->ho_ten_nguoi_nhan }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="thongtin-donhang-item">
                            <div class="text-muted small">Số điện thoại</div>
                            <div class="fw-semibold">{{ $donhang->so_dien_thoai }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="thongtin-donhang-item">
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $donhang->email ?: 'Chưa có' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="thongtin-donhang-item">
                            <div class="text-muted small">Phương thức thanh toán</div>
                            <div class="fw-semibold">
                                {{ ten_phuong_thuc_thanh_toan($donhang->phuong_thuc_thanh_toan) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="thongtin-donhang-item">
                            <div class="text-muted small">Địa chỉ</div>
                            <div class="fw-semibold">
                                {{ $donhang->dia_chi }},
                                {{ $donhang->phuong_xa }},
                                {{ $donhang->quan_huyen }},
                                {{ $donhang->tinh_thanh }}
                            </div>
                        </div>
                    </div>

                    @if ($donhang->ghi_chu)
                        <div class="col-12">
                            <div class="thongtin-donhang-item">
                                <div class="text-muted small">Ghi chú</div>
                                <div class="fw-semibold">{{ $donhang->ghi_chu }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="khoi-noidung mb-3">
                <div class="khoi-noidung-title">Cập nhật trạng thái</div>

                <form action="{{ route('quantri.donhang.update', $donhang) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trạng thái đơn hàng</label>

                        <select name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
                            <option value="cho_xac_nhan" @selected($donhang->trang_thai === 'cho_xac_nhan')>
                                Chờ xác nhận
                            </option>
                            <option value="da_xac_nhan" @selected($donhang->trang_thai === 'da_xac_nhan')>
                                Đã xác nhận
                            </option>
                            <option value="dang_giao_hang" @selected($donhang->trang_thai === 'dang_giao_hang')>
                                Đang giao hàng
                            </option>
                            <option value="hoan_thanh" @selected($donhang->trang_thai === 'hoan_thanh')>
                                Hoàn thành
                            </option>
                            <option value="da_huy" @selected($donhang->trang_thai === 'da_huy')>
                                Đã hủy
                            </option>
                        </select>

                        @error('trang_thai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-chinh w-100">
                        <i class="bi bi-check2 me-1"></i>
                        Cập nhật trạng thái
                    </button>
                </form>
            </div>

            <div class="khoi-noidung">
                <div class="khoi-noidung-title">Tổng thanh toán</div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tiền hàng</span>
                    <span class="fw-semibold">{{ dinh_dang_tien($donhang->tong_tien_hang) }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Phí vận chuyển</span>
                    <span class="fw-semibold">{{ dinh_dang_tien($donhang->phi_van_chuyen) }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Giảm giá</span>
                    <span class="fw-semibold">{{ dinh_dang_tien($donhang->giam_gia) }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Tổng cộng</span>
                    <span class="tong-tien-donhang">
                        {{ dinh_dang_tien($donhang->tong_thanh_toan) }}
                    </span>
                </div>

                <div class="text-muted small mt-3">
                    Đơn hàng tạo lúc {{ $donhang->created_at->format('H:i d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
@endsection
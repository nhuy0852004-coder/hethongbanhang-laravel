@extends('cuahang.layouts.ungdung')

@section('tieude', 'Giỏ hàng')

@section('noidung')
    <section class="container py-4">
        <div class="cuahang-page-title">
            <div>
                <h1>Giỏ hàng</h1>
                <p>Kiểm tra sản phẩm, số lượng và tổng tiền trước khi thanh toán</p>
            </div>
        </div>

        @if (session('thanhcong'))
            <div class="alert alert-success">{{ session('thanhcong') }}</div>
        @endif

        @if (session('loi'))
            <div class="alert alert-danger">{{ session('loi') }}</div>
        @endif

        @if (count($gioHang) > 0)
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="giohang-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="fw-bold">Sản phẩm trong giỏ</div>

                            <form action="{{ route('cuahang.giohang.xoatatca') }}"
                                  method="POST"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-light border text-danger">
                                    Xóa tất cả
                                </button>
                            </form>
                        </div>

                        <form id="formCapnhatGiohang"
                              action="{{ route('cuahang.giohang.capnhat') }}"
                              method="POST">
                            @csrf
                            @method('PATCH')
                        </form>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th style="width: 130px;">Số lượng</th>
                                        <th style="width: 150px;">Thành tiền</th>
                                        <th class="text-end" style="width: 80px;">Xóa</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($gioHang as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="giohang-anh">
                                                        @if ($item['anh_dai_dien'])
                                                            <img src="{{ asset('storage/' . $item['anh_dai_dien']) }}"
                                                                 alt="{{ $item['ten_san_pham'] }}">
                                                        @else
                                                            <i class="bi bi-image text-muted"></i>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('cuahang.sanpham.show', $item['duong_dan']) }}"
                                                           class="fw-bold text-dark text-decoration-none">
                                                            {{ $item['ten_san_pham'] }}
                                                        </a>

                                                        <div class="text-muted small mt-1">
                                                            Giá: {{ dinh_dang_tien($item['gia_hien_tai']) }}
                                                        </div>

                                                        <div class="text-muted small">
                                                            Tồn kho: {{ $item['so_luong_ton'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <input type="number"
                                                       form="formCapnhatGiohang"
                                                       name="so_luong[{{ $item['sanpham_id'] }}]"
                                                       value="{{ $item['so_luong'] }}"
                                                       min="0"
                                                       max="{{ $item['so_luong_ton'] }}"
                                                       class="form-control">
                                            </td>

                                            <td>
                                                <div class="fw-bold text-danger">
                                                    {{ dinh_dang_tien($item['gia_hien_tai'] * $item['so_luong']) }}
                                                </div>
                                            </td>

                                            <td class="text-end">
                                                <form action="{{ route('cuahang.giohang.xoa', $item['sanpham_id']) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-light border text-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-light border">
                                <i class="bi bi-arrow-left me-1"></i>
                                Tiếp tục mua sắm
                            </a>

                            <button type="submit" form="formCapnhatGiohang" class="btn btn-primary">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="giohang-card">
                        <div class="fw-bold mb-3">Tóm tắt đơn hàng</div>

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

                        <a href="{{ route('cuahang.thanhtoan.index') }}" class="btn btn-primary w-100 mt-4">
                            Thanh toán
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="trang-rong-cuahang">
                <i class="bi bi-cart3 fs-1 text-muted"></i>
                <div class="fw-bold mt-3">Giỏ hàng đang trống</div>
                <div class="text-muted mt-1">Hãy chọn sản phẩm để bắt đầu đặt hàng.</div>

                <a href="{{ route('cuahang.sanpham.index') }}" class="btn btn-primary mt-3">
                    Xem sản phẩm
                </a>
            </div>
        @endif
    </section>
@endsection
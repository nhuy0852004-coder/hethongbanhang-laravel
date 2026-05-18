@extends('quantri.layouts.ungdung')

@section('tieude', 'Quản lý khách hàng')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Quản lý khách hàng</h1>
            <p>Theo dõi thông tin khách hàng, số điện thoại và lịch sử mua hàng</p>
        </div>
    </div>

    <div class="khoi-noidung mb-3">
        <form action="{{ route('quantri.khachhang.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-6">
                <label class="form-label fw-semibold">Tìm kiếm khách hàng</label>

                <div class="position-relative">
                    <i class="bi bi-search position-absolute text-muted" style="top: 10px; left: 12px;"></i>

                    <input type="text"
                           name="tu_khoa"
                           value="{{ $boLoc['tu_khoa'] ?? '' }}"
                           class="form-control ps-5"
                           placeholder="Nhập tên, số điện thoại hoặc email...">
                </div>
            </div>

            <div class="col-lg-6 d-flex gap-2">
                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-search me-1"></i>
                    Tìm kiếm
                </button>

                <a href="{{ route('quantri.khachhang.index') }}" class="btn btn-light border">
                    Làm mới
                </a>
            </div>
        </form>
    </div>

    <div class="khoi-noidung">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="khoi-noidung-title mb-1">Danh sách khách hàng</div>
                <div class="text-muted small">
                    Tổng cộng {{ $danhsachKhachhang->total() }} khách hàng
                </div>
            </div>
        </div>

        @if ($danhsachKhachhang->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle bang-quantri">
                    <thead>
                        <tr>
                            <th style="width: 26%;">Khách hàng</th>
                            <th style="width: 18%;">Liên hệ</th>
                            <th style="width: 24%;">Địa chỉ</th>
                            <th style="width: 12%;">Đơn hàng</th>
                            <th style="width: 14%;">Chi tiêu</th>
                            <th class="text-end" style="width: 6%;">Xem</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhsachKhachhang as $khachhang)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-khachhang">
                                            {{ mb_substr($khachhang->ho_ten, 0, 1) }}
                                        </div>

                                        <div>
                                            <div class="fw-semibold text-dark">
                                                {{ $khachhang->ho_ten }}
                                            </div>

                                            <div class="text-muted small">
                                                Khách hàng #{{ $khachhang->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $khachhang->so_dien_thoai }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $khachhang->email ?: 'Chưa có email' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($khachhang->dia_chi)
                                        <div class="text-dark">
                                            {{ $khachhang->dia_chi }}
                                        </div>

                                        <div class="text-muted small">
                                            {{ $khachhang->phuong_xa }},
                                            {{ $khachhang->quan_huyen }},
                                            {{ $khachhang->tinh_thanh }}
                                        </div>
                                    @else
                                        <span class="text-muted">Chưa có địa chỉ</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $khachhang->donhang_count }} đơn
                                    </span>
                                </td>

                                <td>
                                    <div class="fw-bold text-danger">
                                        {{ dinh_dang_tien($khachhang->tong_chi_tieu ?? 0) }}
                                    </div>

                                    <div class="text-muted small">
                                        Đơn hoàn thành
                                    </div>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('quantri.khachhang.show', $khachhang) }}"
                                       class="btn btn-sm btn-light border">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $danhsachKhachhang->links() }}
            </div>
        @else
            <div class="trang-rong">
                <div class="trang-rong-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div class="fw-bold mt-3">Chưa có khách hàng nào</div>
                <div class="text-muted mt-1">
                    Khi khách đặt hàng, thông tin khách hàng sẽ tự động lưu tại đây.
                </div>
            </div>
        @endif
    </div>
@endsection

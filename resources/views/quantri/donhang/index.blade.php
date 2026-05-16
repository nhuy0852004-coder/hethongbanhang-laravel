@extends('quantri.layouts.ungdung')

@section('tieude', 'Quản lý đơn hàng')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Quản lý đơn hàng</h1>
            <p>Theo dõi đơn hàng, thông tin khách hàng và trạng thái xử lý</p>
        </div>
    </div>

    <div class="khoi-noidung mb-3">
        <form action="{{ route('quantri.donhang.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-4">
                <label class="form-label fw-semibold">Tìm kiếm</label>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute text-muted" style="top: 10px; left: 12px;"></i>
                    <input type="text"
                           name="tu_khoa"
                           value="{{ $boLoc['tu_khoa'] ?? '' }}"
                           class="form-control ps-5"
                           placeholder="Mã đơn, tên khách, số điện thoại...">
                </div>
            </div>

            <div class="col-lg-2">
                <label class="form-label fw-semibold">Trạng thái</label>
                <select name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="cho_xac_nhan" @selected(($boLoc['trang_thai'] ?? '') === 'cho_xac_nhan')>
                        Chờ xác nhận
                    </option>
                    <option value="da_xac_nhan" @selected(($boLoc['trang_thai'] ?? '') === 'da_xac_nhan')>
                        Đã xác nhận
                    </option>
                    <option value="dang_giao_hang" @selected(($boLoc['trang_thai'] ?? '') === 'dang_giao_hang')>
                        Đang giao hàng
                    </option>
                    <option value="hoan_thanh" @selected(($boLoc['trang_thai'] ?? '') === 'hoan_thanh')>
                        Hoàn thành
                    </option>
                    <option value="da_huy" @selected(($boLoc['trang_thai'] ?? '') === 'da_huy')>
                        Đã hủy
                    </option>
                </select>
            </div>

            <div class="col-lg-2">
                <label class="form-label fw-semibold">Từ ngày</label>
                <input type="date"
                       name="tu_ngay"
                       value="{{ $boLoc['tu_ngay'] ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-lg-2">
                <label class="form-label fw-semibold">Đến ngày</label>
                <input type="date"
                       name="den_ngay"
                       value="{{ $boLoc['den_ngay'] ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-lg-2 d-flex gap-2">
                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-funnel me-1"></i>
                    Lọc
                </button>

                <a href="{{ route('quantri.donhang.index') }}" class="btn btn-light border">
                    Làm mới
                </a>
            </div>
        </form>
    </div>

    <div class="khoi-noidung">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="khoi-noidung-title mb-1">Danh sách đơn hàng</div>
                <div class="text-muted small">
                    Tổng cộng {{ $danhsachDonhang->total() }} đơn hàng
                </div>
            </div>
        </div>

        @if ($danhsachDonhang->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle bang-quantri">
                    <thead>
                        <tr>
                            <th style="width: 16%;">Mã đơn</th>
                            <th style="width: 22%;">Khách hàng</th>
                            <th style="width: 18%;">Thời gian</th>
                            <th style="width: 16%;">Tổng tiền</th>
                            <th style="width: 16%;">Trạng thái</th>
                            <th class="text-end" style="width: 12%;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhsachDonhang as $donhang)
                            <tr>
                                <td>
                                    <div class="fw-bold text-primary">
                                        {{ $donhang->ma_don_hang }}
                                    </div>

                                    <div class="text-muted small mt-1">
                                        {{ ten_phuong_thuc_thanh_toan($donhang->phuong_thuc_thanh_toan) }}
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ $donhang->ho_ten_nguoi_nhan }}
                                    </div>

                                    <div class="text-muted small mt-1">
                                        {{ $donhang->so_dien_thoai }}
                                    </div>

                                    @if ($donhang->email)
                                        <div class="text-muted small">
                                            {{ $donhang->email }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $donhang->created_at->format('d/m/Y') }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $donhang->created_at->format('H:i') }}
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-bold text-danger">
                                        {{ dinh_dang_tien($donhang->tong_thanh_toan) }}
                                    </div>

                                    <div class="text-muted small">
                                        Tiền hàng: {{ dinh_dang_tien($donhang->tong_tien_hang) }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge-trangthai {{ class_trang_thai_don_hang($donhang->trang_thai) }}">
                                        {{ ten_trang_thai_don_hang($donhang->trang_thai) }}
                                    </span>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('quantri.donhang.show', $donhang) }}"
                                       class="btn btn-sm btn-light border">
                                        <i class="bi bi-eye me-1"></i>
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $danhsachDonhang->links() }}
            </div>
        @else
            <div class="trang-rong">
                <div class="trang-rong-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div class="fw-bold mt-3">Chưa có đơn hàng nào</div>
                <div class="text-muted mt-1">
                    Khi khách đặt hàng ngoài website, đơn hàng sẽ hiển thị tại đây.
                </div>
            </div>
        @endif
    </div>
@endsection
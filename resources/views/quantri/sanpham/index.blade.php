@extends('quantri.layouts.ungdung')

@section('tieude', 'Quản lý sản phẩm')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Quản lý sản phẩm</h1>
            <p>Quản lý sản phẩm, giá bán, tồn kho và trạng thái hiển thị</p>
        </div>

        <button class="btn btn-chinh" data-bs-toggle="modal" data-bs-target="#modalThemSanpham">
            <i class="bi bi-plus-lg me-1"></i>
            Thêm sản phẩm
        </button>
    </div>

    <div class="khoi-noidung mb-3">
        <form action="{{ route('quantri.sanpham.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-4">
                <label class="form-label fw-semibold">Tìm kiếm</label>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute text-muted" style="top: 10px; left: 12px;"></i>
                    <input type="text"
                           name="tu_khoa"
                           value="{{ $boLoc['tu_khoa'] ?? '' }}"
                           class="form-control ps-5"
                           placeholder="Tên sản phẩm hoặc mã sản phẩm...">
                </div>
            </div>

            <div class="col-lg-3">
                <label class="form-label fw-semibold">Danh mục</label>
                <select name="danhmuc_id" class="form-select">
                    <option value="">Tất cả danh mục</option>

                    @foreach ($danhsachDanhmuc as $danhmuc)
                        <option value="{{ $danhmuc->id }}" @selected(($boLoc['danhmuc_id'] ?? '') == $danhmuc->id)>
                            {{ $danhmuc->ten_danh_muc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-2">
                <label class="form-label fw-semibold">Trạng thái</label>
                <select name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="hien_thi" @selected(($boLoc['trang_thai'] ?? '') === 'hien_thi')>Hiển thị</option>
                    <option value="an" @selected(($boLoc['trang_thai'] ?? '') === 'an')>Ẩn</option>
                    <option value="het_hang" @selected(($boLoc['trang_thai'] ?? '') === 'het_hang')>Hết hàng</option>
                </select>
            </div>

            <div class="col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-funnel me-1"></i>
                    Lọc
                </button>

                <a href="{{ route('quantri.sanpham.index') }}" class="btn btn-light border">
                    Làm mới
                </a>
            </div>
        </form>
    </div>

    <div class="khoi-noidung">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="khoi-noidung-title mb-1">Danh sách sản phẩm</div>
                <div class="text-muted small">
                    Tổng cộng {{ $danhsachSanpham->total() }} sản phẩm
                </div>
            </div>
        </div>

        @if ($danhsachSanpham->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle bang-quantri">
                    <thead>
                        <tr>
                            <th style="width: 34%;">Sản phẩm</th>
                            <th style="width: 16%;">Danh mục</th>
                            <th style="width: 15%;">Giá bán</th>
                            <th style="width: 12%;">Tồn kho</th>
                            <th style="width: 13%;">Trạng thái</th>
                            <th class="text-end" style="width: 10%;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhsachSanpham as $sanpham)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="anh-sanpham-nho">
                                            @if ($sanpham->anh_dai_dien)
                                                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                                                     alt="{{ $sanpham->ten_san_pham }}">
                                            @else
                                                <i class="bi bi-image text-muted"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="fw-semibold text-dark">
                                                {{ $sanpham->ten_san_pham }}
                                            </div>

                                            <div class="text-muted small mt-1">
                                                Mã: {{ $sanpham->ma_san_pham }}
                                            </div>

                                            <div class="text-muted small">
                                                /{{ $sanpham->duong_dan }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if ($sanpham->danhmuc)
                                        <span class="text-dark">{{ $sanpham->danhmuc->ten_danh_muc }}</span>
                                    @else
                                        <span class="text-muted">Chưa có</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($sanpham->gia_khuyen_mai)
                                        <div class="fw-bold text-danger">
                                            {{ dinh_dang_tien($sanpham->gia_khuyen_mai) }}
                                        </div>
                                        <div class="text-muted small text-decoration-line-through">
                                            {{ dinh_dang_tien($sanpham->gia_ban) }}
                                        </div>
                                    @else
                                        <div class="fw-bold">
                                            {{ dinh_dang_tien($sanpham->gia_ban) }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if ($sanpham->so_luong_ton <= 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                            Hết hàng
                                        </span>
                                    @elseif ($sanpham->so_luong_ton <= 5)
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                            {{ $sanpham->so_luong_ton }} sản phẩm
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border">
                                            {{ $sanpham->so_luong_ton }} sản phẩm
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($sanpham->trang_thai === 'hien_thi')
                                        <span class="badge-trangthai badge-hoat-dong">Hiển thị</span>
                                    @elseif ($sanpham->trang_thai === 'an')
                                        <span class="badge-trangthai badge-tam-an">Ẩn</span>
                                    @else
                                        <span class="badge-trangthai badge-het-hang">Hết hàng</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light border btn-sm" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border">
                                            <li>
                                                <button type="button"
                                                        class="dropdown-item"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalSuaSanpham{{ $sanpham->id }}">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Sửa sản phẩm
                                                </button>
                                            </li>

                                            <li>
                                                <form action="{{ route('quantri.sanpham.doi-trang-thai', $sanpham) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="dropdown-item">
                                                        @if ($sanpham->trang_thai === 'hien_thi')
                                                            <i class="bi bi-eye-slash me-2"></i>
                                                            Ẩn sản phẩm
                                                        @else
                                                            <i class="bi bi-eye me-2"></i>
                                                            Bật hiển thị
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>

                                            <li><hr class="dropdown-divider"></li>

                                            <li>
                                                <form action="{{ route('quantri.sanpham.destroy', $sanpham) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>
                                                        Xóa sản phẩm
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $danhsachSanpham->links() }}
            </div>

            @foreach ($danhsachSanpham as $sanpham)
                @include('quantri.sanpham.hopthoaisua', [
                    'sanpham' => $sanpham,
                    'danhsachDanhmuc' => $danhsachDanhmuc
                ])
            @endforeach
        @else
            <div class="trang-rong">
                <div class="trang-rong-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="fw-bold mt-3">Chưa có sản phẩm nào</div>
                <div class="text-muted mt-1">
                    Hãy thêm sản phẩm đầu tiên để bắt đầu bán hàng.
                </div>

                <button class="btn btn-chinh mt-3" data-bs-toggle="modal" data-bs-target="#modalThemSanpham">
                    <i class="bi bi-plus-lg me-1"></i>
                    Thêm sản phẩm
                </button>
            </div>
        @endif
    </div>

    @include('quantri.sanpham.hopthoaithem')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cacInputAnh = document.querySelectorAll('.input-anh-sanpham, #anh_dai_dien');
            const cacInputTien = document.querySelectorAll('.nhap-tien-vnd');

            cacInputAnh.forEach(function (input) {
                input.addEventListener('change', function () {
                    const file = this.files[0];
                    const previewId = this.dataset.preview || 'xemTruocAnhSanpham';
                    const khungXemAnh = document.getElementById(previewId);

                    if (!khungXemAnh) {
                        return;
                    }

                    if (!file) {
                        khungXemAnh.innerHTML = '<i class="bi bi-image text-muted fs-1"></i>';
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function (event) {
                        khungXemAnh.innerHTML = `<img src="${event.target.result}" alt="Ảnh sản phẩm">`;
                    };

                    reader.readAsDataURL(file);
                });
            });

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
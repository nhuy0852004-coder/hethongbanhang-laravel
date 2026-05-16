@extends('quantri.layouts.ungdung')

@section('tieude', 'Quản lý danh mục')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Quản lý danh mục</h1>
            <p>Quản lý nhóm sản phẩm, trạng thái hiển thị và cấu trúc danh mục</p>
        </div>

        <button class="btn btn-chinh" data-bs-toggle="modal" data-bs-target="#modalThemDanhmuc">
            <i class="bi bi-plus-lg me-1"></i>
            Thêm danh mục
        </button>
    </div>

    <div class="khoi-noidung mb-3">
        <form action="{{ route('quantri.danhmuc.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-5">
                <label class="form-label fw-semibold">Tìm kiếm</label>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute text-muted" style="top: 10px; left: 12px;"></i>
                    <input type="text"
                           name="tu_khoa"
                           value="{{ $boLoc['tu_khoa'] ?? '' }}"
                           class="form-control ps-5"
                           placeholder="Nhập tên danh mục hoặc mô tả...">
                </div>
            </div>

            <div class="col-lg-3">
                <label class="form-label fw-semibold">Trạng thái</label>
                <select name="trang_thai" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="hoat_dong" @selected(($boLoc['trang_thai'] ?? '') === 'hoat_dong')>
                        Hoạt động
                    </option>
                    <option value="tam_an" @selected(($boLoc['trang_thai'] ?? '') === 'tam_an')>
                        Tạm ẩn
                    </option>
                </select>
            </div>

            <div class="col-lg-4 d-flex gap-2">
                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-funnel me-1"></i>
                    Lọc dữ liệu
                </button>

                <a href="{{ route('quantri.danhmuc.index') }}" class="btn btn-light border">
                    Làm mới
                </a>
            </div>
        </form>
    </div>

    <div class="khoi-noidung">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="khoi-noidung-title mb-1">Danh sách danh mục</div>
                <div class="text-muted small">
                    Tổng cộng {{ $danhsachDanhmuc->total() }} danh mục
                </div>
            </div>
        </div>

        @if ($danhsachDanhmuc->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle bang-quantri">
                    <thead>
                        <tr>
                            <th style="width: 32%;">Tên danh mục</th>
                            <th style="width: 18%;">Danh mục cha</th>
                            <th style="width: 12%;">Thứ tự</th>
                            <th style="width: 14%;">Sản phẩm</th>
                            <th style="width: 12%;">Trạng thái</th>
                            <th class="text-end" style="width: 12%;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhsachDanhmuc as $danhmuc)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ $danhmuc->ten_danh_muc }}
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Đường dẫn: /{{ $danhmuc->duong_dan }}
                                    </div>

                                    @if ($danhmuc->mo_ta)
                                        <div class="text-muted small mt-1">
                                            {{ \Illuminate\Support\Str::limit($danhmuc->mo_ta, 70) }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if ($danhmuc->danhmucCha)
                                        <span class="text-dark">{{ $danhmuc->danhmucCha->ten_danh_muc }}</span>
                                    @else
                                        <span class="text-muted">Danh mục gốc</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $danhmuc->thu_tu }}
                                    </span>
                                </td>

                                <td>
                                    <div class="text-dark fw-semibold">
                                        {{ $danhmuc->sanpham_count }} sản phẩm
                                    </div>
                                    <div class="text-muted small">
                                        {{ $danhmuc->danhmuc_con_count }} mục con
                                    </div>
                                </td>

                                <td>
                                    @if ($danhmuc->trang_thai === 'hoat_dong')
                                        <span class="badge-trangthai badge-hoat-dong">
                                            Hoạt động
                                        </span>
                                    @else
                                        <span class="badge-trangthai badge-tam-an">
                                            Tạm ẩn
                                        </span>
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
                                                        data-bs-target="#modalSuaDanhmuc{{ $danhmuc->id }}">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Sửa danh mục
                                                </button>
                                            </li>

                                            <li>
                                                <form action="{{ route('quantri.danhmuc.doi-trang-thai', $danhmuc) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="dropdown-item">
                                                        @if ($danhmuc->trang_thai === 'hoat_dong')
                                                            <i class="bi bi-eye-slash me-2"></i>
                                                            Tạm ẩn
                                                        @else
                                                            <i class="bi bi-eye me-2"></i>
                                                            Bật hoạt động
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>

                                            <li><hr class="dropdown-divider"></li>

                                            <li>
                                                <form action="{{ route('quantri.danhmuc.destroy', $danhmuc) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>
                                                        Xóa danh mục
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
                {{ $danhsachDanhmuc->links() }}
            </div>

            @foreach ($danhsachDanhmuc as $danhmuc)
                @include('quantri.danhmuc.hopthoaisua', [
                    'danhmuc' => $danhmuc,
                    'danhsachDanhmucCha' => $danhsachDanhmucCha
                ])
            @endforeach
        @else
            <div class="trang-rong">
                <div class="trang-rong-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>

                <div class="fw-bold mt-3">Chưa có danh mục nào</div>
                <div class="text-muted mt-1">
                    Hãy thêm danh mục đầu tiên để bắt đầu quản lý sản phẩm.
                </div>

                <button class="btn btn-chinh mt-3" data-bs-toggle="modal" data-bs-target="#modalThemDanhmuc">
                    <i class="bi bi-plus-lg me-1"></i>
                    Thêm danh mục
                </button>
            </div>
        @endif
    </div>

    @include('quantri.danhmuc.hopthoaithem')
@endsection
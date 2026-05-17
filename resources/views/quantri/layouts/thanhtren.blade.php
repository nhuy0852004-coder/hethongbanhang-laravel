<header class="quantri-header">
    <div class="quantri-search">
        <i class="bi bi-search"></i>
        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm, đơn hàng, khách hàng...">
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn btn-light position-relative border"
                    data-bs-toggle="dropdown"
                    id="nutChuongThongbao">
                <i class="bi bi-bell"></i>

                <span id="soLuongThongbaoChuaDoc"
                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ ($soLuongThongbaoChuaDoc ?? 0) > 0 ? '' : 'd-none' }}">
                    {{ $soLuongThongbaoChuaDoc ?? 0 }}
                </span>
            </button>

            <div class="dropdown-menu dropdown-menu-end shadow-sm border thongbao-dropdown">
                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                    <div class="fw-bold">Thông báo</div>

                    <a href="{{ route('quantri.thongbao.index') }}" class="small text-decoration-none">
                        Xem tất cả
                    </a>
                </div>

                <div id="danhsachThongbaoHeader">
                    @forelse (($danhsachThongbaoHeader ?? []) as $thongbao)
                        <a href="{{ $thongbao->du_lieu['duong_dan'] ?? route('quantri.thongbao.index') }}"
                           class="thongbao-header-item {{ $thongbao->da_doc ? '' : 'chua-doc' }}">
                            <div class="fw-semibold">{{ $thongbao->tieu_de }}</div>
                            <div class="text-muted small">{{ $thongbao->noi_dung }}</div>
                            <div class="text-muted small mt-1">{{ dinh_dang_ngay_gio($thongbao->created_at) }}</div>
                        </a>
                    @empty
                        <div class="text-center text-muted py-4" id="thongbaoHeaderRong">
                            Chưa có thông báo
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-light border d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                     style="width: 34px; height: 34px;">
                    {{ mb_substr(auth()->user()->ho_ten ?? 'A', 0, 1) }}
                </div>

                <div class="text-start d-none d-md-block">
                    <div class="fw-semibold">{{ auth()->user()->ho_ten ?? 'Quản trị viên' }}</div>
                    <div class="text-muted small">Admin hệ thống</div>
                </div>

                <i class="bi bi-chevron-down small"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border">
                <li>
                    <span class="dropdown-item-text small text-muted">
                        {{ auth()->user()->email ?? '' }}
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('dangxuat') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Đăng xuất
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
<header class="quantri-header">
    <div class="quantri-search">
        <i class="bi bi-search"></i>
        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm, đơn hàng, khách hàng...">
    </div>

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light position-relative border">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
            </span>
        </button>

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
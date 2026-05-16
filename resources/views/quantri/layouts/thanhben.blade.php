<aside class="quantri-sidebar">
    <div class="quantri-logo">
        <i class="bi bi-shop me-2"></i>
        Bán Hàng Pro
    </div>

    <nav class="quantri-menu">
        <div class="quantri-menu-title">Tổng quan</div>

        <a href="{{ route('quantri.bangdieukhien') }}"
           class="quantri-menu-link {{ request()->routeIs('quantri.bangdieukhien') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Bảng điều khiển</span>
        </a>

        <div class="quantri-menu-title">Quản lý bán hàng</div>

        <a href="{{ route('quantri.danhmuc.index') }}"
           class="quantri-menu-link {{ request()->routeIs('quantri.danhmuc.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Danh mục</span>
        </a>

        <a href="{{ route('quantri.sanpham.index') }}"
           class="quantri-menu-link {{ request()->routeIs('quantri.sanpham.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Sản phẩm</span>
        </a>

        <a href="{{ route('quantri.donhang.index') }}"
           class="quantri-menu-link {{ request()->routeIs('quantri.donhang.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Đơn hàng</span>
        </a>

        <a href="#" class="quantri-menu-link">
            <i class="bi bi-people"></i>
            <span>Khách hàng</span>
        </a>

        <div class="quantri-menu-title">Vận hành</div>

        <a href="#" class="quantri-menu-link">
            <i class="bi bi-bell"></i>
            <span>Thông báo</span>
        </a>

        <a href="#" class="quantri-menu-link">
            <i class="bi bi-bar-chart"></i>
            <span>Báo cáo doanh thu</span>
        </a>

        <a href="#" class="quantri-menu-link">
            <i class="bi bi-gear"></i>
            <span>Cài đặt cửa hàng</span>
        </a>
    </nav>
</aside>
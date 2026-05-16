<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#F8FAFC;">
    <div class="min-vh-100 d-flex align-items-center justify-content-center px-3">
        <div class="card border-0 shadow-sm" style="width: 430px; border-radius: 14px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-3 bg-primary text-white"
                         style="width: 52px; height: 52px;">
                        <i class="bi bi-shop fs-3"></i>
                    </div>

                    <h1 class="h4 fw-bold mb-1">Đăng nhập quản trị</h1>
                    <p class="text-muted mb-0">Quản lý cửa hàng và đơn hàng của bạn</p>
                </div>

                @if (session('loi'))
                    <div class="alert alert-danger">
                        {{ session('loi') }}
                    </div>
                @endif

                @if (session('thanhcong'))
                    <div class="alert alert-success">
                        {{ session('thanhcong') }}
                    </div>
                @endif

                <form action="{{ route('dangnhap.xuly') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@gmail.com"
                               autofocus>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mật khẩu</label>
                        <input type="password"
                               name="mat_khau"
                               class="form-control @error('mat_khau') is-invalid @enderror"
                               placeholder="Nhập mật khẩu">

                        @error('mat_khau')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <label class="form-check mb-0">
                            <input type="checkbox" name="ghi_nho" class="form-check-input">
                            <span class="form-check-label">Ghi nhớ đăng nhập</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        Đăng nhập
                    </button>
                </form>

                <div class="text-center text-muted small mt-4">
                    Tài khoản mẫu: admin@gmail.com / 12345678
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@extends('quantri.layouts.ungdung')

@section('tieude', 'Cài đặt cửa hàng')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Cài đặt cửa hàng</h1>
            <p>Quản lý thông tin thương hiệu, liên hệ và chính sách hiển thị ngoài website</p>
        </div>
    </div>

    @if (session('thanhcong'))
        <div class="alert alert-success">{{ session('thanhcong') }}</div>
    @endif

    @if (session('loi'))
        <div class="alert alert-danger">{{ session('loi') }}</div>
    @endif

    <form action="{{ route('quantri.caidat.capnhat') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-lg-4">
                <div class="khoi-noidung">
                    <div class="khoi-noidung-title">Logo cửa hàng</div>

                    <div id="xemTruocLogoCuaHang" class="khung-logo-caidat mb-3">
                        @if ($caidat->logo)
                            <img src="{{ asset('storage/' . $caidat->logo) }}" alt="{{ $caidat->ten_cua_hang }}">
                        @else
                            <div class="logo-caidat-rong">
                                <i class="bi bi-shop"></i>
                            </div>
                        @endif
                    </div>

                    <div class="nhom-upload-file">
                        <input type="file"
                               id="logo"
                               name="logo"
                               accept="image/png,image/jpeg,image/jpg,image/webp"
                               class="input-file-an input-logo-caidat @error('logo') is-invalid @enderror"
                               data-preview="xemTruocLogoCuaHang">

                        <label for="logo" class="nut-upload-file">
                            <span class="upload-file-left">
                                <span class="upload-file-icon">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </span>

                                <span>
                                    <span class="upload-file-title">Chọn logo cửa hàng</span>
                                    <span class="upload-file-name ten-file-upload">Chưa chọn tệp</span>
                                </span>
                            </span>

                            <span class="upload-file-action">Chọn ảnh</span>
                        </label>

                        @error('logo')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-muted small mt-3">
                        Khuyến nghị dùng ảnh vuông, định dạng PNG hoặc WEBP, dung lượng dưới 2MB.
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="khoi-noidung mb-3">
                    <div class="khoi-noidung-title">Thông tin cửa hàng</div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                Tên cửa hàng <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="ten_cua_hang"
                                   value="{{ old('ten_cua_hang', $caidat->ten_cua_hang) }}"
                                   class="form-control @error('ten_cua_hang') is-invalid @enderror"
                                   placeholder="Ví dụ: Bán Hàng Pro">

                            @error('ten_cua_hang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số điện thoại</label>

                            <input type="text"
                                   name="so_dien_thoai"
                                   value="{{ old('so_dien_thoai', $caidat->so_dien_thoai) }}"
                                   class="form-control @error('so_dien_thoai') is-invalid @enderror"
                                   placeholder="0900000000">

                            @error('so_dien_thoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $caidat->email) }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="hotro@cuahang.vn">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Địa chỉ</label>

                            <input type="text"
                                   name="dia_chi"
                                   value="{{ old('dia_chi', $caidat->dia_chi) }}"
                                   class="form-control @error('dia_chi') is-invalid @enderror"
                                   placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành">

                            @error('dia_chi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="khoi-noidung">
                    <div class="khoi-noidung-title">Chính sách cửa hàng</div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chính sách vận chuyển</label>

                        <textarea name="chinh_sach_van_chuyen"
                                  rows="5"
                                  class="form-control @error('chinh_sach_van_chuyen') is-invalid @enderror"
                                  placeholder="Nhập chính sách vận chuyển của cửa hàng">{{ old('chinh_sach_van_chuyen', $caidat->chinh_sach_van_chuyen) }}</textarea>

                        @error('chinh_sach_van_chuyen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label fw-semibold">Chính sách đổi trả</label>

                        <textarea name="chinh_sach_doi_tra"
                                  rows="5"
                                  class="form-control @error('chinh_sach_doi_tra') is-invalid @enderror"
                                  placeholder="Nhập chính sách đổi trả của cửa hàng">{{ old('chinh_sach_doi_tra', $caidat->chinh_sach_doi_tra) }}</textarea>

                        @error('chinh_sach_doi_tra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('quantri.caidat.index') }}" class="btn btn-light border">
                            Làm mới
                        </a>

                        <button type="submit" class="btn btn-chinh">
                            <i class="bi bi-check2 me-1"></i>
                            Lưu cài đặt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputLogo = document.querySelector('.input-logo-caidat');

            if (!inputLogo) {
                return;
            }

            inputLogo.addEventListener('change', function () {
                const file = this.files[0];
                const previewId = this.dataset.preview;
                const khungXemAnh = document.getElementById(previewId);
                const tenFile = this.closest('.nhom-upload-file')?.querySelector('.ten-file-upload');

                if (tenFile) {
                    tenFile.textContent = file ? file.name : 'Chưa chọn tệp';
                }

                if (!khungXemAnh) {
                    return;
                }

                if (!file) {
                    khungXemAnh.innerHTML = `
                        <div class="logo-caidat-rong">
                            <i class="bi bi-shop"></i>
                        </div>
                    `;
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    khungXemAnh.innerHTML = `<img src="${event.target.result}" alt="Logo cửa hàng">`;
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush

<div class="modal fade" id="modalThemSanpham" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="{{ route('quantri.sanpham.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="modal-content modal-quantri">
            @csrf

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold mb-1">Thêm sản phẩm</h5>
                    <div class="text-muted small">Nhập thông tin sản phẩm, giá bán và tồn kho</div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">Ảnh sản phẩm</label>

                        <div id="xemTruocAnhSanpham" class="khung-upload-sanpham mb-3">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>

                        <div class="nhom-upload-file">
                            <input type="file"
                                   id="anh_dai_dien"
                                   name="anh_dai_dien"
                                   accept="image/png,image/jpeg,image/jpg,image/webp"
                                   class="input-file-an input-anh-sanpham @error('anh_dai_dien') is-invalid @enderror"
                                   data-preview="xemTruocAnhSanpham">

                            <label for="anh_dai_dien" class="nut-upload-file">
                                <span class="upload-file-left">
                                    <span class="upload-file-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </span>

                                    <span>
                                        <span class="upload-file-title">Chọn ảnh sản phẩm</span>
                                        <span class="upload-file-name ten-file-upload">Chưa chọn tệp</span>
                                    </span>
                                </span>

                                <span class="upload-file-action">Chọn ảnh</span>
                            </label>

                            @error('anh_dai_dien')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-text">
                            Chọn ảnh đại diện cho sản phẩm. Hỗ trợ JPG, PNG, WEBP.
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="ten_san_pham"
                                   value="{{ old('ten_san_pham') }}"
                                   class="form-control @error('ten_san_pham') is-invalid @enderror"
                                   placeholder="Ví dụ: Áo thun nam basic">

                            @error('ten_san_pham')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mã sản phẩm</label>

                                <input type="text"
                                       name="ma_san_pham"
                                       value="{{ old('ma_san_pham') }}"
                                       class="form-control @error('ma_san_pham') is-invalid @enderror"
                                       placeholder="Tự tạo nếu để trống">

                                @error('ma_san_pham')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Danh mục <span class="text-danger">*</span>
                                </label>

                                <select name="danhmuc_id"
                                        class="form-select @error('danhmuc_id') is-invalid @enderror">
                                    <option value="">Chọn danh mục</option>

                                    @foreach ($danhsachDanhmuc as $danhmuc)
                                        <option value="{{ $danhmuc->id }}" @selected(old('danhmuc_id') == $danhmuc->id)>
                                            {{ $danhmuc->ten_danh_muc }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('danhmuc_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Giá bán <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <input type="text"
                                           name="gia_ban"
                                           value="{{ old('gia_ban') }}"
                                           class="form-control nhap-tien-vnd @error('gia_ban') is-invalid @enderror"
                                           placeholder="120.000">
                                    <span class="input-group-text">₫</span>
                                </div>

                                @error('gia_ban')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Giá khuyến mãi</label>

                                <div class="input-group">
                                    <input type="text"
                                           name="gia_khuyen_mai"
                                           value="{{ old('gia_khuyen_mai') }}"
                                           class="form-control nhap-tien-vnd @error('gia_khuyen_mai') is-invalid @enderror"
                                           placeholder="99.000">
                                    <span class="input-group-text">₫</span>
                                </div>

                                @error('gia_khuyen_mai')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Tồn kho <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                       name="so_luong_ton"
                                       value="{{ old('so_luong_ton', 0) }}"
                                       min="0"
                                       class="form-control @error('so_luong_ton') is-invalid @enderror"
                                       placeholder="0">

                                @error('so_luong_ton')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Trạng thái</label>

                            <select name="trang_thai"
                                    class="form-select @error('trang_thai') is-invalid @enderror">
                                <option value="hien_thi" @selected(old('trang_thai', 'hien_thi') === 'hien_thi')>
                                    Hiển thị
                                </option>
                                <option value="an" @selected(old('trang_thai') === 'an')>
                                    Ẩn
                                </option>
                                <option value="het_hang" @selected(old('trang_thai') === 'het_hang')>
                                    Hết hàng
                                </option>
                            </select>

                            @error('trang_thai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Mô tả ngắn</label>

                            <textarea name="mo_ta_ngan"
                                      rows="2"
                                      class="form-control @error('mo_ta_ngan') is-invalid @enderror"
                                      placeholder="Mô tả ngắn hiển thị ở danh sách sản phẩm">{{ old('mo_ta_ngan') }}</textarea>

                            @error('mo_ta_ngan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Mô tả chi tiết</label>

                            <textarea name="mo_ta_chi_tiet"
                                      rows="4"
                                      class="form-control @error('mo_ta_chi_tiet') is-invalid @enderror"
                                      placeholder="Nhập mô tả chi tiết sản phẩm">{{ old('mo_ta_chi_tiet') }}</textarea>

                            @error('mo_ta_chi_tiet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                    Hủy
                </button>

                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-check2 me-1"></i>
                    Lưu sản phẩm
                </button>
            </div>
        </form>
    </div>
</div>
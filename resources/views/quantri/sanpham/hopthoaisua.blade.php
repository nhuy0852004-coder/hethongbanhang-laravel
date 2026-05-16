<div class="modal fade" id="modalSuaSanpham{{ $sanpham->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="{{ route('quantri.sanpham.update', $sanpham) }}"
              method="POST"
              enctype="multipart/form-data"
              class="modal-content modal-quantri">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold mb-1">Sửa sản phẩm</h5>
                    <div class="text-muted small">Cập nhật thông tin sản phẩm, giá bán và tồn kho</div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">Ảnh sản phẩm</label>

                        <div id="xemTruocAnhSanpham{{ $sanpham->id }}" class="khung-upload-sanpham mb-3">
                            @if ($sanpham->anh_dai_dien)
                                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                                     alt="{{ $sanpham->ten_san_pham }}">
                            @else
                                <i class="bi bi-image text-muted fs-1"></i>
                            @endif
                        </div>

                        <div class="nhom-upload-file">
                            <input type="file"
                                   id="anh_dai_dien_sua_{{ $sanpham->id }}"
                                   name="anh_dai_dien"
                                   accept="image/png,image/jpeg,image/jpg,image/webp"
                                   class="input-file-an input-anh-sanpham @error('anh_dai_dien') is-invalid @enderror"
                                   data-preview="xemTruocAnhSanpham{{ $sanpham->id }}">

                            <label for="anh_dai_dien_sua_{{ $sanpham->id }}" class="nut-upload-file">
                                <span class="upload-file-left">
                                    <span class="upload-file-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </span>

                                    <span>
                                        <span class="upload-file-title">Thay ảnh sản phẩm</span>
                                        <span class="upload-file-name ten-file-upload">Chưa chọn ảnh mới</span>
                                    </span>
                                </span>

                                <span class="upload-file-action">Chọn ảnh</span>
                            </label>

                            @error('anh_dai_dien')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-text">
                            Chọn ảnh mới nếu muốn thay ảnh hiện tại.
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="ten_san_pham"
                                   value="{{ old('ten_san_pham', $sanpham->ten_san_pham) }}"
                                   class="form-control"
                                   placeholder="Ví dụ: Áo thun nam basic">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mã sản phẩm</label>

                                <input type="text"
                                       name="ma_san_pham"
                                       value="{{ old('ma_san_pham', $sanpham->ma_san_pham) }}"
                                       class="form-control"
                                       placeholder="Tự tạo nếu để trống">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Danh mục <span class="text-danger">*</span>
                                </label>

                                <select name="danhmuc_id" class="form-select">
                                    <option value="">Chọn danh mục</option>

                                    @foreach ($danhsachDanhmuc as $danhmuc)
                                        <option value="{{ $danhmuc->id }}"
                                            @selected(old('danhmuc_id', $sanpham->danhmuc_id) == $danhmuc->id)>
                                            {{ $danhmuc->ten_danh_muc }}
                                        </option>
                                    @endforeach
                                </select>
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
                                           value="{{ old('gia_ban', number_format($sanpham->gia_ban, 0, ',', '.')) }}"
                                           class="form-control nhap-tien-vnd"
                                           placeholder="120.000">
                                    <span class="input-group-text">₫</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Giá khuyến mãi</label>

                                <div class="input-group">
                                    <input type="text"
                                           name="gia_khuyen_mai"
                                           value="{{ old('gia_khuyen_mai', $sanpham->gia_khuyen_mai ? number_format($sanpham->gia_khuyen_mai, 0, ',', '.') : '') }}"
                                           class="form-control nhap-tien-vnd"
                                           placeholder="99.000">
                                    <span class="input-group-text">₫</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Tồn kho <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                       name="so_luong_ton"
                                       value="{{ old('so_luong_ton', $sanpham->so_luong_ton) }}"
                                       min="0"
                                       class="form-control"
                                       placeholder="0">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Trạng thái</label>

                            <select name="trang_thai" class="form-select">
                                <option value="hien_thi" @selected(old('trang_thai', $sanpham->trang_thai) === 'hien_thi')>
                                    Hiển thị
                                </option>

                                <option value="an" @selected(old('trang_thai', $sanpham->trang_thai) === 'an')>
                                    Ẩn
                                </option>

                                <option value="het_hang" @selected(old('trang_thai', $sanpham->trang_thai) === 'het_hang')>
                                    Hết hàng
                                </option>
                            </select>

                            <div class="form-text">
                                Nếu tồn kho bằng 0, hệ thống sẽ tự chuyển về trạng thái hết hàng.
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Mô tả ngắn</label>

                            <textarea name="mo_ta_ngan"
                                      rows="2"
                                      class="form-control"
                                      placeholder="Mô tả ngắn hiển thị ở danh sách sản phẩm">{{ old('mo_ta_ngan', $sanpham->mo_ta_ngan) }}</textarea>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold">Mô tả chi tiết</label>

                            <textarea name="mo_ta_chi_tiet"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Nhập mô tả chi tiết sản phẩm">{{ old('mo_ta_chi_tiet', $sanpham->mo_ta_chi_tiet) }}</textarea>
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
                    Cập nhật sản phẩm
                </button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalThemDanhmuc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('quantri.danhmuc.store') }}" method="POST" class="modal-content modal-quantri">
            @csrf

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold mb-1">Thêm danh mục</h5>
                    <div class="text-muted small">Tạo danh mục mới để phân nhóm sản phẩm trong cửa hàng</div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Tên danh mục <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="ten_danh_muc"
                           value="{{ old('ten_danh_muc') }}"
                           class="form-control @error('ten_danh_muc') is-invalid @enderror"
                           placeholder="Ví dụ: Áo nam, Quần nữ, Phụ kiện">

                    @error('ten_danh_muc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Danh mục cha</label>

                    <select name="danhmuc_cha_id"
                            class="form-select @error('danhmuc_cha_id') is-invalid @enderror">
                        <option value="">Danh mục gốc</option>

                        @foreach ($danhsachDanhmucCha as $danhmucCha)
                            <option value="{{ $danhmucCha->id }}"
                                @selected(old('danhmuc_cha_id') == $danhmucCha->id)>
                                {{ $danhmucCha->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>

                    @error('danhmuc_cha_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-text">
                        Để trống nếu đây là danh mục cấp gốc.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>

                    <textarea name="mo_ta"
                              rows="3"
                              class="form-control @error('mo_ta') is-invalid @enderror"
                              placeholder="Nhập mô tả ngắn cho danh mục">{{ old('mo_ta') }}</textarea>

                    @error('mo_ta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Thứ tự hiển thị</label>

                        <input type="number"
                               name="thu_tu"
                               value="{{ old('thu_tu', 0) }}"
                               min="0"
                               class="form-control @error('thu_tu') is-invalid @enderror"
                               placeholder="0">

                        @error('thu_tu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text">
                            Số nhỏ sẽ được hiển thị trước.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Trạng thái</label>

                        <select name="trang_thai"
                                class="form-select @error('trang_thai') is-invalid @enderror">
                            <option value="hoat_dong" @selected(old('trang_thai', 'hoat_dong') === 'hoat_dong')>
                                Hoạt động
                            </option>

                            <option value="tam_an" @selected(old('trang_thai') === 'tam_an')>
                                Tạm ẩn
                            </option>
                        </select>

                        @error('trang_thai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text">
                            Danh mục tạm ẩn sẽ không hiển thị ngoài website.
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
                    Lưu danh mục
                </button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalSuaDanhmuc{{ $danhmuc->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('quantri.danhmuc.update', $danhmuc) }}" method="POST" class="modal-content modal-quantri">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold mb-1">Sửa danh mục</h5>
                    <div class="text-muted small">Cập nhật thông tin danh mục sản phẩm</div>
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
                           value="{{ old('ten_danh_muc', $danhmuc->ten_danh_muc) }}"
                           class="form-control"
                           placeholder="Ví dụ: Áo nam">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Danh mục cha</label>

                    <select name="danhmuc_cha_id" class="form-select">
                        <option value="">Danh mục gốc</option>

                        @foreach ($danhsachDanhmucCha as $danhmucCha)
                            @if ($danhmucCha->id !== $danhmuc->id)
                                <option value="{{ $danhmucCha->id }}"
                                    @selected(old('danhmuc_cha_id', $danhmuc->danhmuc_cha_id) == $danhmucCha->id)>
                                    {{ $danhmucCha->ten_danh_muc }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>

                    <textarea name="mo_ta"
                              rows="3"
                              class="form-control"
                              placeholder="Nhập mô tả ngắn cho danh mục">{{ old('mo_ta', $danhmuc->mo_ta) }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Thứ tự</label>

                        <input type="number"
                               name="thu_tu"
                               value="{{ old('thu_tu', $danhmuc->thu_tu) }}"
                               min="0"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Trạng thái</label>

                        <select name="trang_thai" class="form-select">
                            <option value="hoat_dong" @selected(old('trang_thai', $danhmuc->trang_thai) === 'hoat_dong')>
                                Hoạt động
                            </option>

                            <option value="tam_an" @selected(old('trang_thai', $danhmuc->trang_thai) === 'tam_an')>
                                Tạm ẩn
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                    Hủy
                </button>

                <button type="submit" class="btn btn-chinh">
                    <i class="bi bi-check2 me-1"></i>
                    Cập nhật danh mục
                </button>
            </div>
        </form>
    </div>
</div>
@if (session('thanhcong'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show border-0 shadow-sm">
            <div class="toast-header">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                <strong class="me-auto">Thành công</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('thanhcong') }}
            </div>
        </div>
    </div>
@endif

@if (session('loi'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show border-0 shadow-sm">
            <div class="toast-header">
                <i class="bi bi-x-circle-fill text-danger me-2"></i>
                <strong class="me-auto">Có lỗi xảy ra</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('loi') }}
            </div>
        </div>
    </div>
@endif
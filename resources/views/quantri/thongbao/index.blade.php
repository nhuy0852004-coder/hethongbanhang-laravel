@extends('quantri.layouts.ungdung')

@section('tieude', 'Thông báo')

@section('noidung')
    <div class="trang-tieude">
        <div>
            <h1>Thông báo</h1>
            <p>Theo dõi đơn hàng mới và các cảnh báo trong hệ thống</p>
        </div>

        <form action="{{ route('quantri.thongbao.danh-dau-tat-ca-da-doc') }}" method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn btn-light border">
                <i class="bi bi-check2-all me-1"></i>
                Đánh dấu tất cả đã đọc
            </button>
        </form>
    </div>

    @if (session('thanhcong'))
        <div class="alert alert-success">{{ session('thanhcong') }}</div>
    @endif

    <div class="khoi-noidung">
        <div class="khoi-noidung-title">Danh sách thông báo</div>

        @if ($danhsachThongbao->count() > 0)
            <div class="list-group list-group-flush">
                @foreach ($danhsachThongbao as $thongbao)
                    <div class="list-group-item px-0 py-3">
                        <div class="d-flex justify-content-between gap-3">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fw-bold">{{ $thongbao->tieu_de }}</div>

                                    @if (! $thongbao->da_doc)
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            Chưa đọc
                                        </span>
                                    @endif
                                </div>

                                <div class="text-muted mt-1">
                                    {{ $thongbao->noi_dung }}
                                </div>

                                <div class="text-muted small mt-1">
                                    {{ dinh_dang_ngay_gio($thongbao->created_at) }}
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                @if (!empty($thongbao->du_lieu['duong_dan']))
                                    <a href="{{ $thongbao->du_lieu['duong_dan'] }}" class="btn btn-sm btn-light border">
                                        Xem
                                    </a>
                                @endif

                                @if (! $thongbao->da_doc)
                                    <form action="{{ route('quantri.thongbao.danh-dau-da-doc', $thongbao) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Đã đọc
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $danhsachThongbao->links() }}
            </div>
        @else
            <div class="trang-rong">
                <div class="trang-rong-icon">
                    <i class="bi bi-bell"></i>
                </div>

                <div class="fw-bold mt-3">Chưa có thông báo</div>
                <div class="text-muted mt-1">
                    Khi khách đặt hàng, thông báo sẽ xuất hiện tại đây.
                </div>
            </div>
        @endif
    </div>
@endsection
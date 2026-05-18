<?php

namespace App\Providers;

use App\Models\Caidat;
use App\Services\ThongbaoService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('Helpers/dinhdang.php');
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('quantri.layouts.thanhtren', function ($view) {
            $thongbaoService = app(ThongbaoService::class);

            $view->with([
                'soLuongThongbaoChuaDoc' => $thongbaoService->demChuaDoc(),
                'danhsachThongbaoHeader' => $thongbaoService->layThongbaoMoiNhat(),
            ]);
        });

        View::composer([
            'quantri.layouts.thanhben',
            'cuahang.layouts.ungdung',
        ], function ($view) {
            $view->with('caidatChung', Caidat::query()->first());
        });
    }
}

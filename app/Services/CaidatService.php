<?php

namespace App\Services;

use App\Models\Caidat;
use App\Repositories\CaidatRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CaidatService
{
    public function __construct(
        protected CaidatRepository $caidatRepository
    ) {
    }

    public function layCaidat(): Caidat
    {
        return $this->caidatRepository->layCaidat();
    }

    public function capnhat(array $duLieu): bool
    {
        return DB::transaction(function () use ($duLieu) {
            $caidat = $this->caidatRepository->layCaidat();

            if (isset($duLieu['logo'])) {
                if ($caidat->logo && Storage::disk('public')->exists($caidat->logo)) {
                    Storage::disk('public')->delete($caidat->logo);
                }

                $duLieu['logo'] = $duLieu['logo']->store('caidat', 'public');
            }

            return $this->caidatRepository->capnhat($caidat, $duLieu);
        });
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CapnhatTrangthaiDonhangEvent implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public string $maDonHang,
        public array $duLieu
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('donhang.' . $this->maDonHang),
        ];
    }

    public function broadcastAs(): string
    {
        return 'trangthai.capnhat';
    }

    public function broadcastWith(): array
    {
        return $this->duLieu;
    }
}

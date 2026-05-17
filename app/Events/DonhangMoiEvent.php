<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DonhangMoiEvent implements ShouldBroadcastNow
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public array $duLieu
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('quantri.thongbao'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'donhang.moi';
    }

    public function broadcastWith(): array
    {
        return $this->duLieu;
    }
}
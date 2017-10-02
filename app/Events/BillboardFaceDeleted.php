<?php

namespace App\Events;

use App\Models\BillboardFace;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BillboardFaceDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $billboardFace;

    public function __construct(BillboardFace $billboardFace)
    {
        $this->billboardFace = $billboardFace;
    }
}

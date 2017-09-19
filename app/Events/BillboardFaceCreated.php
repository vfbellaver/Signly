<?php

namespace App\Events;

use App\Models\BillboardFace;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BillboardFaceCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $billboardFace;

    public function __construct(BillboardFace $billboardFace)
    {
        $this->billboardFace = $billboardFace;
    }
}

<?php

namespace App\Events;

use App\Models\Billboard;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BillboardCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $billboard;

    public function __construct(Billboard $billboard)
    {
        $this->billboard = $billboard;
    }
}

<?php

namespace App\Events;

use App\Models\Client;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ClientUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}

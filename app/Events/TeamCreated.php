<?php

namespace App\Events;

use App\Models\Team;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TeamCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }
}

<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $sendInvite;

    public function __construct(User $user, bool $emailWasChanged = false)
    {
        $this->user = $user;
        $this->sendInvite = $emailWasChanged;
    }
}

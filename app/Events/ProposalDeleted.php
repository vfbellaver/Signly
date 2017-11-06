<?php

namespace App\Events;

use App\Models\Proposal;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ProposalDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $proposal;

    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 10/24/17
 * Time: 9:55 AM
 */

namespace App\Events;


use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    /**
     * MessageCreated constructor.
     * @param $notification
     */
    public function __construct(Message $notification)
    {
        $this->notification = $notification;
    }


}
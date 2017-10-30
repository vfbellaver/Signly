<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CardExpirationSoon extends Notification
{
    use Queueable;

    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }


    public function via($notifiable)
    {
        return ['mail', 'database'];
    }


    public function toMail($notifiable)
    {
        $msg = $this->notification;
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->subject($msg->subject)
            ->line($msg->message)
            ->action('Update your card', route('login'))
            ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            'subject' => $this->notification->subject,
            'message' => $this->notification->message,
        ];
    }
}

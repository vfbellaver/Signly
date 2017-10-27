<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CardExpirationSoon extends Notification
{
    use Queueable;

    public $notication;

    public function __construct($notification)
    {
        $this->notication = $notification;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $msg = $this->notication;
        return (new MailMessage)
                    ->greeting('Hello '.$notifiable->name.'!')
                    ->subject($msg->subject)
                    ->line($msg->message)
                    ->action('Update your card', route('login'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

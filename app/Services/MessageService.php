<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 10/24/17
 * Time: 10:00 AM
 */

namespace App\Services;


use App\Events\MessageCreated;
use App\Forms\MessageForm;
use App\Models\Message;

class MessageService
{
    public function create(MessageForm $form): Message
    {
        return \DB::transaction(function () use ($form) {
            $data = [
                'subject' => $form->subjetc(),
                'text' => $form->message(),
                'visualized' => $form->visualized(),

            ];
            $notification = new Message($data);
            $notification->save();

            $notification->user()->associate($form->user());

            event(new MessageCreated($notification));

            return $notification;
        });
    }

    public function update(MessageForm $form, Message $message): Message
    {
        return \DB::transaction(function () use ($form,$message) {

            $message->visualized = $form->visualized();

            $message->save();

            return $message;
        });
    }
}
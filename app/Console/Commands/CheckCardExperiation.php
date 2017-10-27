<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\User;
use App\Notifications\CardExpirationSoon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckCardExperiation extends Command
{

    protected $signature = 'check:card:expiration';


    protected $description = 'Check expiration of users cards and save warning message';


    public function handle()
    {
        $users = User::all();
        $msgs = [];

        foreach ($users as $user) {
            $datenow = Carbon::now();
            $dateexp = new Carbon($user->card_expiration);

            $diference = $datenow->diffInDaysFiltered(function (Carbon $date) {
                return $date;
            }, $dateexp);

            if ($diference < 45) {
                $data = [
                    'subject' => 'Card Expiration',
                    'message' => 'Your credit card will expire in ' . $diference . ' days.',
                    'user_id' => $user->id,
                ];

                //create new msg and notification user;
                $newmsg = Message::create($data);
                $user->notify(new CardExpirationSoon($newmsg));

                $msgs [] = $newmsg;

                $this->info('User '.$user->name.' notified by email');
            }

        }
        return $msgs;
    }
}


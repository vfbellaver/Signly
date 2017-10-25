<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckCardExperiation extends Command
{

    protected $signature = 'check:card:expiration';


    protected $description = 'Check expiration of users cards and save warning message';


    public function handle()
    {
        $users = User::all();

        $yearnow = Carbon::now()->year;
        $monthnow = Carbon::now()->month;
        $daynow = Carbon::now()->day;
        //create carbon object
        $datenow = Carbon::create($yearnow, $monthnow, $daynow);

        $msgs = [] ;
        foreach ($users as $user) {
            $monthexp = $user->card_exp_month;
            $yearexp = $user->card_exp_year;
            $dateexp = Carbon::create($yearexp, $monthexp, 31);

            $diference = $datenow->diffInDaysFiltered(function (Carbon $date) {
                return $date;
            }, $dateexp);

            if ($diference < 45) {
                $data = [
                    'subject' => 'Card Expiration',
                    'message' => 'Hi Mr. ' . $user->name . '! Your credit card will expire in '.$diference.' days.',
                    'user_id' => $user->id,
                ];
                $msgs [] = Message::create($data);

            }

        }
        return $msgs;
    }
}


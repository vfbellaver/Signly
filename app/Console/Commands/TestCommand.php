<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\CardExpirationSoon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $data = Carbon::createFromFormat('m/Y','12/2018')->endOfMonth();

        /** @var User $user */
        $user = factory(User::class)->make();
        $user->notify(new CardExpirationSoon());


    }
}

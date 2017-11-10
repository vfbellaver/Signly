<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\CardExpirationSoon;
use Timezone;
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
        $date = Carbon::now();
        $converted = Timezone::convertFromUTC($date->getTimestamp(), 'US/Mountain');
        $this->info($converted);
        $listOfTimeZones = Timezone::getTimezones();
    }
}

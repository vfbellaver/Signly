<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\CardExpirationSoon;
use Faker\Generator;
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

    public function handle(Generator $faker)
    {

    }
}

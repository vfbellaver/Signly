<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        $teamId = \App\Models\Team::query()->max('id');

        if (!$teamId) {
            return;
        }
        factory(\App\Models\Client::class, 25)->create(['team_id' => random_int(1, 6)]);
    }
}

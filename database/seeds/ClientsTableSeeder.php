<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Team::all()->each(function ($team) {
            factory(\App\Models\Client::class, 12)->create(['team_id' => $team->id]);
        });
    }
}

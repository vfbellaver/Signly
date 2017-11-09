<?php

use Illuminate\Database\Seeder;

class BillboardsTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Team::all()->each(function (\App\Models\Team $team) {
            factory(\App\Models\Billboard::class, 25)
                ->create([
                    'team_id' => $team->id
                ])
                ->each(function (\App\Models\Billboard $billboard) use ($team) {
                    factory(\App\Models\BillboardFace::class, rand(1, 4))->create([
                        'billboard_id' => $billboard->id,
                        'team_id' => $team->id
                    ]);
                });
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class BillboardsTableSeeder extends Seeder
{
    public function run()
    {
        $user = \App\Models\User::query()->find(1);
        $team = \App\Models\Team::query()->find(1);

        if (!$user) {
            return;
        }
        factory(\App\Models\Billboard::class, 6)
            ->create([
                'user_id' => $user->id,
                'team_id' => $team->id
            ])

            ->each(function (\App\Models\Billboard $billboard) {
                factory(\App\Models\BillboardFace::class, rand(1, 4))->create([
                    'billboard_id' => $billboard->id,
                ]);
            });
    }
}

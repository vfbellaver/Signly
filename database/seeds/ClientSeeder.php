<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $user = \App\Models\User::query()->find(1);

        if (!$user) {
            return;
        }
        factory(\App\Models\Client::class, 25)->create(['user_id' => $user->id]);
    }
}

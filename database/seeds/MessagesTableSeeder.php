<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::query()->find(1);

        if (!$user) {
            return;
        }
        factory(\App\Models\Message::class, 5)->create(['user_id' => $user->id]);
    }
}

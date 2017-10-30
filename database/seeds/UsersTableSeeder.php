<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $this->createSupportUser();
        if (app()->environment('local')) {
            $this->createAdminUsers();
            $this->createUserUsers();
        }
    }

    public static function createSupportUser()
    {
        $role = Defender::findRole('slc');

        /** @var User $user */
        $user = factory(\App\Models\User::class)->create([
            'name' => 'Support SLC DevShop',
            'email' => 'support@slcdevshop.com',
            'card_expiration' => Carbon::createFromFormat('m/Y', '11/2017')->endOfMonth(),
            'password' => bcrypt('slcdev##'),
            'team_id' => 1
        ]);
        $user->attachRole($role);
    }

    private function createAdminUsers()
    {
        $role = Defender::findRole('admin');

        \App\Models\Team::all()->each(function (\App\Models\Team $team) use ($role) {
            $owner = factory(\App\Models\User::class)
                ->create([
                    'team_id' => $team->id
                ]);
            $team->owner_id = $owner->id;
            $team->save();
        });
    }

    private function createUserUsers()
    {
        $role = Defender::findRole('user');
        \App\Models\Team::all()->each(function (\App\Models\Team $team) use ($role) {
            factory(\App\Models\User::class, 3)
                ->create([
                    'team_id' => $team->id
                ]);
        });
    }
}

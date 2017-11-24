<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Defender::createRole('DevSquad');
        Defender::createRole('Admin');
        Defender::createRole('Account Owner');
        Defender::createRole('Account Member');
    }
}

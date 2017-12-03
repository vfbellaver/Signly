<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TeamTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        if (!app()->environment('production')) {
            $this->call(ClientsTableSeeder::class);
            $this->call(BillboardsTableSeeder::class);
            $this->call(ProposalTableSeeder::class);
        }
    }
}

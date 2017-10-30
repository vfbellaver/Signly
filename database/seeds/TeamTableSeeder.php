<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMainTeam();
        $this->createTeams();
    }

    private function createMainTeam()
    {
        factory(Team::class)->create([
            'name' => 'Support SLC DevShop',
            'slug' => str_slug('Support SLC DevShop')
        ]);
    }

    private function createTeams()
    {
        factory(Team::class, 5)->create();
    }
}

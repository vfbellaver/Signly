<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    public function run()
    {
        $this->createSuperAdminTeam();
        $this->createAdminTeam();
        $this->createTeams();
    }

    private function createSuperAdminTeam()
    {
        factory(Team::class)->create([
            'name' => 'DevSquad',
            'slug' => str_slug('DevSquad')
        ]);
    }

    private function createAdminTeam()
    {
        factory(Team::class)->create([
            'name' => 'Signly',
            'slug' => str_slug('Signly')
        ]);
    }

    private function createTeams()
    {
        factory(Team::class, 1)->create();
    }
}

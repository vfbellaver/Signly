<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMainTeam();
        $this->createTeams();
    }

    private function createMainTeam(){
        $team = factory(Team::class)->create([
            'name' => 'Support SLC DevShop',
        ]);
    }

    private function createTeams()
    {

        factory(Team::class, 5)->create();

    }
}

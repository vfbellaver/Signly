<?php

namespace App\Services;

use App\Events\TeamCreated;
use App\Events\TeamDeleted;
use App\Events\TeamUpdated;
use App\Forms\TeamForm;
use App\Models\Team;

class TeamService
{
    public function create(TeamForm $form): Team
    {
        return \DB::transaction(function () use ($form) {
            $data = [
                'name' => $form->name(),
            ];

            $team = new Team($data);

            $team->save();

            event(new TeamCreated($team));

            return $team;
        });
    }

    public function update(TeamForm $form, Team $team): Team
    {
        return \DB::transaction(function () use ($form, $team) {

            $data = [
                'name' => $form->name(),
            ];

            $team->save();

            event(new TeamUpdated($team));

            return $team;
        });
    }


    public function delete(Team $team)
    {
        return \DB::transaction(function() use ($team) {
           $team->delete();

           event(new TeamDeleted($team));
        });
    }
}
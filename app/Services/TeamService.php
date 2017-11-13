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

            $team->name = $form->name();
            $team->email = $form->email();
            $team->phone1 = $form->phone1();
            $team->phone2 = $form->phone2();
            $team->fax = $form->fax();
            $team->address_line1 = $form->address_line1();
            $team->address_line2 = $form->address_line2();
            $team->city = $form->city();
            $team->state = $form->state();
            $team->zipcode = $form->zipcode();
            $team->logo = $form->logo();
            $team->save();

            event(new TeamUpdated($team));

            return $team;
        });
    }


    public function delete(Team $team)
    {
        return \DB::transaction(function () use ($team) {
            $team->delete();

            event(new TeamDeleted($team));
        });
    }

    public function slug(Team $team)
    {
        return str_slug($team->name, '-');
    }
}
<?php

namespace App\Scopes;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TeamScope implements Scope
{
    private $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('team_id', $this->team->id);
    }
}
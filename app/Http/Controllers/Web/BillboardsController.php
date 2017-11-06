<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Models\Billboard;
use App\Models\BillboardFace;
use App\Models\Team;
use App\Models\User;

class BillboardsController extends Controller
{
    public function index()
    {
        return view('billboard.index');
    }

    public function edit($id)
    {
        $billboard = Billboard::query()->findOrFail($id);
        return view('billboard.edit', [
            'billboard' => $billboard
        ]);
    }

    public function create()
    {
        return view('billboard.create');
    }

    public function show($id)
    {
        $faces = BillboardFace::query()->get()->where('billboard_id', $id);
        $billboard = Billboard::query()->findOrFail($id);
        return view('billboard.show', [
            'billboard' => $billboard,
            'faces' => $faces
        ]);
    }

    public function publicView($teamSlug, $billboardSlug)
    {
        $billboard = Billboard::query()
            ->join('teams', 'teams.id', '=', 'billboards.team_id')

            ->select('billboards.*','teams.id as teamid',
                             'teams.name as teamname','teams.owner_id')
            ->where('teams.slug', $teamSlug)
            ->where('billboards.slug', $billboardSlug)
            ->first();
        $owner = User::query()->where('id',$billboard->team->owner_id)->first();
        return view('billboard.public', [
            'billboard' => $billboard,
            'owner' => $owner
        ]);
    }
}

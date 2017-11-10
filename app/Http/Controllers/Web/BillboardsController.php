<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Models\Billboard;
use App\Models\BillboardFace;
use App\Models\Team;
use App\Models\User;
use App\Services\BillboardPublicService;
use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;

class BillboardsController extends Controller
{
    private $service;

    function __construct(BillboardPublicService $service)
    {
        $this->service = $service;
    }

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
            ->select('billboards.*', 'teams.id as teamid',
                'teams.name as teamname', 'teams.owner_id')
            ->where('teams.slug', $teamSlug)
            ->where('billboards.slug', $billboardSlug)
            ->first();

        $url = $this->service->createPOVUrl($billboard);

        $client = new Client();

        $path = fopen(storage_path().'/app/public/images/pov_img.png','w') or die('Something went wrong');
        $client->request('GET',$url,['timeout' => 10.29,'save_to' => $path]);

        return view('billboard.public', [
            'billboard' => $billboard,
        ]);
    }
}

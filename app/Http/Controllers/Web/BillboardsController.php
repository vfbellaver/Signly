<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Models\Billboard;
use App\Models\BillboardFace;
use App\Models\Team;
use App\Models\User;
use App\Services\BillboardPublicService;
use bar\foo\baz\Object;
use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use PhpParser\Node\Expr\Cast\Object_;

class BillboardsController extends Controller
{
    private $service;

    function __construct(BillboardPublicService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = auth()->user();
        if (true) ;

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

    public function publicView($teamSlug, $faceCode)
    {
        $team = Team::query()->where('teams.slug', 'LIKE', '%' . $teamSlug . '%')->get()->first();
        $faces = BillboardFace::query()->where('billboard_faces.slug', 'LIKE', '%' . $faceCode . '%')->get()->first();

        /*

        $url = $this->service->createPOVUrl($faces);

        $client = new Client();

        $path = fopen(storage_path().'/app/public/images/pov_img.png','w') or die('Something went wrong');
        $client->request('GET',$url,['timeout' => 10.29,'save_to' => $path]);

        */

        return view('billboard.public', compact('team', 'faces'));
    }
}

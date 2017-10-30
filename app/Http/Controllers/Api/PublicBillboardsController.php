<?php

namespace App\Http\Controllers\Api;

use App\Models\Billboard;
use App\Http\Controllers\Controller;
use App\Models\BillboardFace;
use App\Models\Team;
use function Deployer\get;
use Illuminate\Support\Facades\Request;

class PublicBillboardsController extends Controller
{
    public function index()
    {
        return Billboard::all();
    }

    public function makeUrl($id)
    {
        $billboard = Billboard::query()->findOrFail($id);
        $team = Team::query()->findOrFail($billboard->team_id);

        $data['slugBillboard'] = str_slug($billboard->name,'-');
        $data['slugTeam'] = str_slug($team->name,'-');

        session(['billboardId'=> $id]);
        $response = [
            'data' => $data,
        ];

        return $response;
    }

    public function showDetails(){
        $id = Request::session()->get('billboardId');
        $faces = BillboardFace::query()->get()->where('billboard_id',$id);
        $billboard = Billboard::query()->findOrFail($id);
        return view('billboard.show', [
            'billboard' => $billboard,
            'faces' => $faces
        ]);
    }

    public function getBillboard($id){
        $billboard = Billboard::query()->where('id',$id)->get()->toArray();
        return $billboard;
    }

    public function getFaces($id){
        return BillboardFace::query()->where('billboard_id', $id)->get()->toArray();
    }
}

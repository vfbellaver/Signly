<?php

namespace App\Http\Controllers\Api;

use App\Models\Billboard;
use App\Http\Controllers\Controller;
use App\Models\Team;

class PublicBillboardsController extends Controller
{
    public function index()
    {
        return Billboard::all();
    }

    public function getTeam($id)
    {
        return Team::all()->where('id',$id);
    }

    public function showDetails($id){
        $id = $id;
        return $id;
    }
}

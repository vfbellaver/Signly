<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    public function index()
    {
        return view('team.index');
    }

    public function settings()
    {
        return view('team.settings');
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BillboardFacesController extends Controller
{
    public function index()
    {
        return view('billboard_face.index');
    }
}

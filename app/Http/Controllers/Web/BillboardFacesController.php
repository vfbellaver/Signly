<?php

namespace App\Http\Controllers\Web;

use App\Forms\BillboardFaceForm;
use App\Http\Controllers\Controller;
use App\Models\Billboard;

class BillboardFacesController extends Controller
{
    public function index()
    {
        return view('billboard_face.index');
    }

}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BillboardsController extends Controller
{
    public function index()
    {
        return view('billboard.index');
    }
}

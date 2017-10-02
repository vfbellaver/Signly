<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index()
    {
        return view('client.index');
    }
}

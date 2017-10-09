<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Billboard;

class HomeController extends Controller
{
    public function index()
    {

        return view('home');

    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ProposalsController extends Controller
{
    public function index()
    {
        return view('proposal.index');
    }
}

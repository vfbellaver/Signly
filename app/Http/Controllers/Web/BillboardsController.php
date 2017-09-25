<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Billboard;

class BillboardsController extends Controller
{
    public function index()
    {
        return view('billboard.index');
    }

    public function edit($id)
    {
        $billboard = Billboard::query()->findOrFail($id);

        return view('billboard.edit', [
            'billboard' => $billboard
        ]);
    }
}

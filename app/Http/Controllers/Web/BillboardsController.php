<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Models\Billboard;
use App\Models\BillboardFace;

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

    public function create()
    {
        return view('billboard.create');
    }

    public function show($id)
    {
        $faces = BillboardFace::query()->get()->where('billboard_id',$id);
        $billboard = Billboard::query()->findOrFail($id);
        return view('billboard.show', [
            'billboard' => $billboard,
            'faces' => $faces
        ]);
    }

    public function publicPage (BillboardCreateRequest $billboard) {
        return $billboard;
    }

    public function makePublicPage (BillboardCreateRequest $request) {
        str_slug();
    }
}

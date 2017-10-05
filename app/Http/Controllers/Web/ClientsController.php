<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function create()
    {
        return view('client.create');
    }

    public function edit($id)
    {
        $client = Client::query()->findOrFail($id);
        return view('client.edit', [
            'client' => $client
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientImportRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Services\ClientService;

class ClientsController extends Controller
{
    private $service;

    public function __construct(ClientService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Client::all();
    }

    public function show($id)
    {
        return Client::query()->findOrFail($id)->toArray();
    }

    public function csvUpload()
    {
        $files = request()->file('file');

        if (!$files) {
            return [];
        }

        $file = $files[0];
        $data = $this->service->extractCsvFile($file->path());

        return $data;
    }

    public function import(ClientImportRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->service->import($data);
    }

    public function store(ClientCreateRequest $request)
    {

        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Client created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        $obj = $this->service->update($request->form(), $client);

        $response = [
            'message' => 'Client updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Client $client)
    {
        $this->service->delete($client);

        return [
            'message' => 'Client deleted.'
        ];
    }
}

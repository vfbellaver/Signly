<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Http\Requests\BillboardUpdateRequest;
use App\Models\Billboard;
use App\Services\BillboardService;

class BillboardsController extends Controller
{
    private $service;

    public function __construct(BillboardService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Billboard::all();
    }




    public function store(BillboardCreateRequest $request)
    {
        $data = $this->service->create($request->form());



        $response = [
            'message' => 'Billboard created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(BillboardUpdateRequest $request, Billboard $billboard)
    {
        $obj = $this->service->update($request->form(), $billboard);

        $response = [
            'message' => 'Billboard updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Billboard $billboard)
    {
        $this->service->delete($billboard);

        return [
            'message' => 'Billboard deleted.'
        ];
    }
}

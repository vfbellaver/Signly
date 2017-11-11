<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardFaceCreateRequest;
use App\Http\Requests\BillboardFaceUpdateRequest;
use App\Models\BillboardFace;
use App\Services\BillboardFaceService;

class BillboardFacesController extends Controller
{
    private $service;

    public function __construct(BillboardFaceService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        $billboardId = request()->get('bid');
        return BillboardFace::query()->where('billboard_id', $billboardId)->get()->toArray();
    }

    public function search()
    {
        // TODO: add type and formating to columns
        // TODO: figure it out how to format each column
        $columns = [
            'code',
            'photo',
            'label',
            'hard_cost',
            'monthly_impressions',
            'duration',
            'height',
            'width',
            'reads',
            'type',
        ];

        $model = BillboardFace::searchPaginateAndOrder($columns);

        return [
            'model' => $model,
            'columns' => $columns
        ];
    }

    public function store(BillboardFaceCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Billboard face created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(BillboardFaceUpdateRequest $request, BillboardFace $billboardFace)
    {
        $obj = $this->service->update($request->form(), $billboardFace);

        $response = [
            'message' => 'Billboard face updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(BillboardFace $billboardFace)
    {
        $this->service->delete($billboardFace);

        return [
            'message' => 'BillboardFace deleted.'
        ];
    }
}

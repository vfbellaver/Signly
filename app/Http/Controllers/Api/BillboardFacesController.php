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
        $this->service = $service;
    }

    public function index()
    {
        $billboardId = request()->get('bid');
        return BillboardFace::query()->where('billboard_id', $billboardId)->get()->toArray();
    }

    public function search()
    {
        $columns = [
            'code' => ['name' => 'code', 'label' => 'ID', 'width' => 64],
            'photo' => ['name' => 'photo', 'label' => 'Photo', 'searchable' => false, 'width' => 64],
            'location' => ['name' => 'location', 'label' => 'Location', 'searchable' => false],
            'monthly_impressions' => ['name' => 'monthly_impressions', 'label' => 'Mo. Impressions', 'width' => 128],
            'height' => ['name' => 'height', 'label' => 'Height', 'width' => 64],
            'width' => ['name' => 'width', 'label' => 'Width', 'width' => 64],
            'reads' => ['name' => 'reads', 'label' => 'Direction Read', 'width' => 120],
            'type' => ['name' => 'type', 'label' => 'Type', 'width' => 64],
        ];

        $model = BillboardFace::searchPaginateAndOrder($columns);
        $model
            ->getCollection()
            ->transform(function (BillboardFace $item) {
                return array_merge($item->toArray(), [
                    'photo' => [
                        'data' => $item->photo_url,
                        'type' => 'image',
                        'width' => 50,
                        'height' => 33,
                    ],
                ]);
            });

        return [
            'model' => $model,
            'columns' => $columns,
            'action_width' => 108
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
            'message' => 'Billboard face deleted.'
        ];
    }
}

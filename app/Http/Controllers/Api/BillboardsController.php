<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Http\Requests\BillboardImportRequest;
use App\Http\Requests\BillboardUpdateRequest;
use App\Models\Billboard;
use App\Services\BillboardService;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Query\Builder;

class BillboardsController extends Controller
{
    private $service;

    public function __construct(BillboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $query = Billboard::query()->where('team_id', auth()->user()->team_id);
        return $query->get()->all();
    }

    public function show($id)
    {
        return Billboard::query()->findOrFail($id)->toArray();
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

    public function import(BillboardImportRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['team_id'] = auth()->user()->team_id;
        $this->service->import($data);
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

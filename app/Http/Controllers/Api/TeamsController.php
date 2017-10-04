<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Models\Team;
use App\Services\TeamService;

class TeamsController extends Controller
{
    private $service;

    public function __construct(TeamService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Team::all();
    }

    public function store(TeamCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Team created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(TeamUpdateRequest $request, Team $team)
    {
        $obj = $this->service->update($request->form(), $team);

        $response = [
            'message' => 'Team updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Team $team)
    {
        $this->service->delete($team);

        return [
            'message' => 'Team deleted.'
        ];
    }
}

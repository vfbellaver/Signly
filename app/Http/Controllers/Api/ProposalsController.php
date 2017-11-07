<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalCreateRequest;
use App\Http\Requests\ProposalUpdateRequest;
use App\Models\Proposal;
use App\Services\ProposalService;

class ProposalsController extends Controller
{
    private $service;

    public function __construct(ProposalService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Proposal::all();
    }

    public function show($id)
    {
        $user = auth()->user();
        $proposal = Proposal::query()
            ->where('id', $id)
            ->where('team_id', $user->team_id)
            ->firstOrFail();

        return $proposal;
    }

    public function store(ProposalCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Proposal created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(ProposalUpdateRequest $request, Proposal $proposal)
    {
        $obj = $this->service->update($request->form(), $proposal);

        $response = [
            'message' => 'Proposal updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Proposal $proposal)
    {
        $this->service->delete($proposal);

        return [
            'message' => 'Proposal deleted.'
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalBillboardFaceCreateRequest;
use App\Http\Requests\ProposalBillboardFaceReorderRequest;
use App\Http\Requests\ProposalBillboardFaceUpdateRequest;
use App\Http\Requests\ProposalCreateRequest;
use App\Http\Requests\ProposalUpdateRequest;
use App\Models\BillboardFace;
use App\Models\Proposal;
use App\Services\ProposalService;

class ProposalsController extends Controller
{
    private $service;

    public function __construct(ProposalService $service)
    {
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

    public function publicShow($proposalEncryptedId)
    {
        $id = (int)decrypt($proposalEncryptedId);
        $proposal = Proposal::query()
            ->where('id', $id)
            ->firstOrFail();

        return $proposal;
    }

    public function publicProposalBillboards($proposalEncryptedId)
    {
        $id = (int)decrypt($proposalEncryptedId);
        /** @var Proposal $proposal */
        $proposal = Proposal::query()
            ->where('id', $id)
            ->firstOrFail();
        $billboards = [];
        /** @var BillboardFace $face */
        foreach ($proposal->billboardFaces as $face) {
            $billboards[] = $face->billboard->toArray();
        }
        return $billboards;
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

    public function createProposalBillboardFace(ProposalBillboardFaceCreateRequest $request)
    {
        $form = $request->form();

        /** @var Proposal $proposal */
        $proposal = Proposal::query()->find($form->proposalId());

        $data = $this->service->addBillboardFace($form, $proposal);
        $response = [
            'message' => 'Billboard Face added to the proposal.',
            'data' => $data,
        ];

        return $response;
    }

    public function updateProposalBillboardFace(ProposalBillboardFaceUpdateRequest $request, $billboardFaceId)
    {
        if (!$billboardFaceId) {
            return $this->notFound(['message' => 'Not found']);
        }

        $form = $request->form();

        /** @var Proposal $proposal */
        $proposal = Proposal::query()->find($form->proposalId());
        $data = $this->service->updateBillboardFace($form, $proposal);

        $response = [
            'message' => 'Billboard Face update.',
            'data' => $data,
        ];

        return $response;
    }

    public function reorderProposalBillboardFaces(ProposalBillboardFaceReorderRequest $request, Proposal $proposal)
    {
        $form = $request->form();
        $this->service->updateBillboardFaceOrder($form, $proposal);

        $response = [
            'message' => 'Billboard Faces reordered.',
        ];

        return $response;
    }


    public function destroyProposalBillboardFace($proposalId, $billboardFaceId)
    {
        /** @var Proposal $proposal */
        $proposal = Proposal::query()
            ->where('id', $proposalId)
            ->where('team_id', auth()->user()->team_id)
            ->firstOrFail();

        $this->service->destroyBillboardFace($billboardFaceId, $proposal);

        $response = [
            'message' => 'Billboard Face deleted.'
        ];

        return $response;
    }

}

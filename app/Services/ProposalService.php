<?php

namespace App\Services;

use App\Events\ProposalCreated;
use App\Events\ProposalDeleted;
use App\Events\ProposalUpdated;
use App\Forms\ProposalBillboardFaceForm;
use App\Forms\ProposalForm;
use App\Models\BillboardFace;
use App\Models\Proposal;
use DB;

class ProposalService
{
    public function create(ProposalForm $form): Proposal
    {
        return DB::transaction(function () use ($form) {
            $data = [
                'name' => $form->name(),
                'team_id' => auth()->user()->team_id,
                'client_id' => $form->clientId(),
                'user_id' => $form->userId(),
                'from_date' => $form->fromDate(),
                'to_date' => $form->toDate(),
                'budget' => $form->budget(),
                'confidence' => $form->confidence(),
            ];

            $proposal = new Proposal($data);
            $proposal->save();
            event(new ProposalCreated($proposal));
            return $proposal;
        });
    }

    public function update(ProposalForm $form, Proposal $proposal): Proposal
    {
        return DB::transaction(function () use ($form, $proposal) {
            $proposal->name = $form->name();
            $proposal->client()->associate($form->client());
            $proposal->save();
            event(new ProposalUpdated($proposal));
            return $proposal;
        });
    }

    public function delete(Proposal $proposal)
    {
        return DB::transaction(function () use ($proposal) {
            $proposal->delete();
            event(new ProposalDeleted($proposal));
        });
    }

    public function addBillboardFace(ProposalBillboardFaceForm $form, Proposal $proposal)
    {
        return DB::transaction(function () use ($form, $proposal) {

            $maxOrder = DB::table('proposal_billboard_face')
                ->where(['proposal_id' => $proposal->id])
                ->max('order');

            $proposal->billboardFaces()->attach($form->billboardFaceId(), [
                'price' => $form->price(),
                'order' => $maxOrder ? $maxOrder + 1 : 0
            ]);

            $face = BillboardFace::query()->find($form->billboardFaceId())->toArray();
            $face['pivot'] = [
                'billboard_face_id' => $form->billboardFaceId(),
                'order' => $maxOrder + 1,
                'price' => number_format($form->price(), 2),
                'proposal_id' => $proposal->id,
            ];

            event(new ProposalUpdated($proposal));
            return $face;
        });
    }

    public function updateBillboardFace(ProposalBillboardFaceForm $form, Proposal $proposal)
    {
        return DB::transaction(function () use ($form, $proposal) {

            DB::table('proposal_billboard_face')
                ->where([
                    'billboard_face_id' => $form->billboardFaceId(),
                    'proposal_id' => $proposal->id,
                ])
                ->update([
                    'price' => $form->price(),
                ]);

            $pivot = DB::table('proposal_billboard_face')->where([
                'billboard_face_id' => $form->billboardFaceId(),
                'proposal_id' => $proposal->id,
            ])->first();

            $face = BillboardFace::query()->find($form->billboardFaceId())->toArray();
            $face['pivot'] = [
                'billboard_face_id' => $form->billboardFaceId(),
                'order' => $pivot->order,
                'price' => number_format($form->price(), 2),
                'proposal_id' => $proposal->id,
            ];

            event(new ProposalUpdated($proposal));
            return $face;
        });
    }

    public function destroyBillboardFace($billboardFaceId, Proposal $proposal)
    {
        return DB::transaction(function () use ($billboardFaceId, $proposal) {
            DB::table('proposal_billboard_face')
                ->where([
                    'billboard_face_id' => $billboardFaceId,
                    'proposal_id' => $proposal->id,
                ])
                ->delete();
            event(new ProposalUpdated($proposal));
        });
    }

    public function updateBillboardFaceOrder(ProposalBillboardFaceForm $form, Proposal $proposal)
    {
        DB::transaction(function () use ($form, $proposal) {

            $orderList = $form->orderList();
            foreach ($orderList as $index => $billboardFaceId) {
                DB::table('proposal_billboard_face')
                    ->where([
                        'billboard_face_id' => $billboardFaceId,
                        'proposal_id' => $proposal->id,
                    ])
                    ->update([
                        'order' => ($index + 1),
                    ]);
            }

            event(new ProposalUpdated($proposal));
        });
    }

}
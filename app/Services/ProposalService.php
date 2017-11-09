<?php

namespace App\Services;

use App\Events\ProposalCreated;
use App\Events\ProposalDeleted;
use App\Events\ProposalUpdated;
use App\Forms\ProposalForm;
use App\Models\Proposal;

class ProposalService
{
    public function create(ProposalForm $form): Proposal
    {
        return \DB::transaction(function () use ($form) {
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
        return \DB::transaction(function () use ($form, $proposal) {

            $proposal->name = $form->name();
            $proposal->client()->associate($form->client());

            $proposal->save();

            event(new ProposalUpdated($proposal));

            return $proposal;
        });
    }

    public function delete(Proposal $proposal)
    {
        return \DB::transaction(function () use ($proposal) {
            $proposal->delete();
            event(new ProposalDeleted($proposal));
        });
    }
}
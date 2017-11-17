<?php

namespace App\Http\Requests;

use App\Forms\ProposalBillboardFaceForm;
use App\Models\Proposal;

class ProposalBillboardFaceUpdateRequest extends BaseRequest
{
    public function form(): ProposalBillboardFaceForm
    {
        return new ProposalBillboardFaceForm($this);
    }

    public function authorize()
    {
        return Proposal::query()
            ->where('id', $this->request->get('proposal_id'))
            ->where('team_id', auth()->user()->team_id)->exists();
    }

    public function rules()
    {
        return [
            'price' => 'required',
            'proposal_id' => 'required',
        ];
    }
}

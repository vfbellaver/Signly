<?php

namespace App\Http\Requests;

use App\Forms\ProposalBillboardFaceForm;

class ProposalBillboardFaceCreateRequest extends BaseRequest
{
    public function form(): ProposalBillboardFaceForm
    {
        return new ProposalBillboardFaceForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'price' => 'required'
        ];
    }
}

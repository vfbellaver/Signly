<?php

namespace App\Http\Requests;

use App\Forms\ProposalForm;

class ProposalCreateRequest extends BaseRequest
{
    public function form(): ProposalForm
    {
        return new ProposalForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'client' => 'required',
        ];
    }
}

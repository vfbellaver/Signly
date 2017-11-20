<?php

namespace App\Http\Requests;

use App\Forms\ProposalForm;

class ProposalUpdateRequest extends BaseRequest
{
    public function form(): ProposalForm
    {
        return new ProposalForm($this);
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['user_id'] = auth()->id();
        $this->replace($data);

        $this->request->replace($data);
        return $this->all();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'client' => 'required',
            'user_id' => 'required',
            'from_date' => 'required|date_format:m/d/Y',
            'to_date' => 'required|date_format:m/d/Y|after:from_date',
        ];
    }

    public function labels()
    {
        return [
            'from_date' => 'Time frame start date',
            'from_end' => 'Time frame end date'
        ];
    }
}

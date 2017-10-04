<?php

namespace App\Http\Requests;

use App\Forms\BillboardFaceForm;

class BillboardFaceCreateRequest extends BaseRequest
{
    public function form(): BillboardFaceForm
    {
        return new BillboardFaceForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'code' => 'required',
			'height' => 'required',
			'width' => 'required',
			'reads' => 'required',
			'label' => 'required',
			'hard_cost' => 'required',
			'monthly_impressions' => 'required',
			'notes' => 'required',
			'max_ads' => 'required|numeric',
			'duration' => 'required|numeric',
			'photo' => 'required',
			'billboard' => 'required|numeric',
        ];
    }
}

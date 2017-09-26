<?php

namespace App\Http\Requests;

use App\Forms\BillboardFaceForm;

class BillboardFaceUpdateRequest extends BaseRequest
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
			'sign_type' => 'required|numeric',
			'hard_cost' => 'required',
			'monthly_impressions' => 'required',
			'notes' => 'required',
			'max_ads' => 'required|numeric',
			'duration' => 'required|numeric',
			'photo' => 'required',
			'is_iluminated' => 'required',
			'billboard' => 'required|numeric',
        ];
    }
}

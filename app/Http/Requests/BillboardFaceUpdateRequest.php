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
			'label' => 'required',
			'rate_card' => 'required',
			'monthly_impressions' => 'required',
			'duration' => 'required|numeric',
			'photo_url' => 'required',
			'billboard' => 'required|numeric',
        ];
    }
}

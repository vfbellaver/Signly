<?php

namespace App\Http\Requests;

use App\Forms\BillboardForm;

class BillboardUpdateRequest extends BaseRequest
{
    public function form(): BillboardForm
    {
        return new BillboardForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'name' => 'required',
			'description' => 'required',
			'digital_driveby' => 'required',
			'address' => 'required',
			'lat' => 'required',
			'lng' => 'required',
        ];
    }
}

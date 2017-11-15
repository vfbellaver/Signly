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
        $id = $this->request->get('id');

        return [
            'code' => 'required|unique:billboard_faces,code,' . $id,
            'label' => 'required',
            'rate_card' => 'required',
            'monthly_impressions' => 'required',
            'photo_url' => 'required',
            'billboard' => 'required|numeric',
        ];
    }
}

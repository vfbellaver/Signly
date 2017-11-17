<?php

namespace App\Http\Requests;

use App\Forms\BillboardFaceForm;
use App\Models\BillboardFace;

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

    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['rate_card'] = str_replace(',', '', $data['rate_card']);
        $data['monthly_impressions'] = str_replace(',', '', $data['monthly_impressions']);

        if ($data['type'] == BillboardFace::TYPE_DIGITAL) {
            $data['is_illuminated'] = null;
            $data['lights_on'] = null;
            $data['lights_off'] = null;
        }

        if ($data['type'] == BillboardFace::TYPE_STATIC) {
            $data['duration'] = null;
            $data['max_ads'] = null;
        }

        $this->replace($data);
        $this->request->replace($data);
        return $this->all();
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

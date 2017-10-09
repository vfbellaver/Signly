<?php

namespace App\Http\Requests;

use App\Forms\BillboardForm;

class BillboardCreateRequest extends BaseRequest
{
    public function form(): BillboardForm
    {
        return new BillboardForm($this);
    }

    protected function prepareForValidation()
    {
        $data = request()->all();
        $data['user'] = auth()->user();
        $this->request->replace($data);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }
}

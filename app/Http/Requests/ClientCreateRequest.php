<?php

namespace App\Http\Requests;

use App\Forms\ClientForm;

class ClientCreateRequest extends BaseRequest
{
    public function form(): ClientForm
    {
        return new ClientForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'company_name' => 'required',
			'logo' => 'nullable',
			'first_name' => 'nullable',
			'last_name' => 'nullable',
			'email' => 'nullable',
			'address_line1' => 'nullable',
			'address_line2' => 'nullable',
			'city' => 'nullable',
			'zipcode' => 'nullable',
			'state' => 'nullable',
			'phone1' => 'nullable',
			'phone2' => 'nullable',
			'fax' => 'nullable',
        ];
    }
}

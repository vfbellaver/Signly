<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ];
    }

    public function labels()
    {
        return [
            'lat' => 'Latitude',
            'lng' => 'Longitude'
        ];
    }
}

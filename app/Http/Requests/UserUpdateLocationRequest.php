<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateLocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required',
        ];
    }

    public function labels()
    {
        return [
            'lat' => 'Latitude',
            'lng' => 'Longitude',
            'address' => 'Address'
        ];
    }
}

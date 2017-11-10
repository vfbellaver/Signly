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
            'timezone' => 'required',
        ];
    }

    public function labels()
    {
        return [
            'lat' => 'Latitude',
            'lng' => 'Longitude',
            'timezone' => 'Your time zone is not set.'
        ];
    }
}

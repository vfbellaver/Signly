<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePhotoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'photo_url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'photo_url.required' => 'User photo is required'
        ];
    }
}

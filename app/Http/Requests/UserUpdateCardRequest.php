<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateCardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Card information is required'
        ];
    }
}

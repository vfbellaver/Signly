<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'plan' => 'required',
            'company' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'card' => 'required',
            'terms_of_service' => 'required|accepted'
        ];
    }


    public function messages()
    {
        return [
            'plan.required' => 'You must choose a plan',
        ];
    }

}

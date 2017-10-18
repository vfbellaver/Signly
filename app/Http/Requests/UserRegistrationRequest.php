<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|string|min:6|confirmed',
            'stripeEmail' => 'required|email|unique:users,email',
            'team' => 'required|unique:teams,name',
            'plan' => 'required',
        ];
    }
}

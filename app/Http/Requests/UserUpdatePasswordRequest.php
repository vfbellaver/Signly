<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed',
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required|same:new_password'
        ];
    }
}

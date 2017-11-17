<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;
use App\Rules\PasswordFormat;
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
            'current_password' => ['required', new CurrentPassword],
            'new_password' => ['required', new PasswordFormat],
            'confirm_password' => 'required|same:new_password'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;
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
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ];
    }
}

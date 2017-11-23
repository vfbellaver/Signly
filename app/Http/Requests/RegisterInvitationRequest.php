<?php

namespace App\Http\Requests;

use App\Rules\PasswordFormat;
use Illuminate\Foundation\Http\FormRequest;

class RegisterInvitationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'password' => ['required', new PasswordFormat],
            'password_confirmation' => 'required|same:password'
        ];
    }
}

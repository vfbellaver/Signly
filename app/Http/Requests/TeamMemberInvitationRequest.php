<?php

namespace App\Http\Requests;

use App\Forms\UserForm;
use Illuminate\Foundation\Http\FormRequest;

class TeamMemberInvitationRequest extends FormRequest
{
    public function form(): UserForm
    {
        return new UserForm($this);
    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email'
        ];
    }
}

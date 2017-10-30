<?php

namespace App\Http\Requests;

use App\Forms\CardForm;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRegistrationRequest extends FormRequest
{
    public function form(): CardForm
    {
        return new CardForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'team' => 'required|unique:teams,name',
            'plan' => 'required',
        ];
    }
}

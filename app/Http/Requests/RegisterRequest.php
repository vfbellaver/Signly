<?php

namespace App\Http\Requests;

use App\Forms\CardForm;
use App\Rules\PasswordFormat;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
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
            'owner'            => 'required',
            'company'          => 'required|unique:teams,name',
            'name'             => 'required',
            'email'            => 'required|email|unique:teams,email',
            'password'         => ['required', 'confirmed', new PasswordFormat],
            'terms_of_service' => 'required|accepted',
        ];
    }


    public function messages()
    {
        return [
            'plan.required'  => 'You must choose a plan',
            'owner.required' => 'Please type the Cardholder name',
        ];
    }

}

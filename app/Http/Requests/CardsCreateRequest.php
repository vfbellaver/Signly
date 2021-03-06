<?php

namespace App\Http\Requests;

use App\Forms\CardForm;
use Illuminate\Foundation\Http\FormRequest;

class CardsCreateRequest extends FormRequest
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
            'source' => 'required',
            'owner' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'owner.required' => 'Please type the Cardholder name',
        ];
    }
}

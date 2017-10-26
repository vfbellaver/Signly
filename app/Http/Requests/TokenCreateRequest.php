<?php

namespace App\Http\Requests;

use App\Forms\CardForm;
use Illuminate\Foundation\Http\FormRequest;

class TokenCreateRequest extends FormRequest
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

            "number" => "required|numeric",
            "exp_month" => "required|numeric",
            "exp_year" => "required|numeric",
            "cvc" => "required|numeric"

        ];
    }
}

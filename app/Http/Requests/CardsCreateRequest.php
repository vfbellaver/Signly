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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'number' => 'required',
            'address_zip' => 'required',
        ];
    }
}

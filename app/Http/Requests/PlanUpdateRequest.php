<?php

namespace App\Http\Requests;

use App\Forms\CardForm;
use Illuminate\Foundation\Http\FormRequest;

class PlanUpdateRequest extends BaseRequest
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

            'stripe_plan' => 'required',

        ];
    }

}

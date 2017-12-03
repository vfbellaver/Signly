<?php

namespace App\Http\Requests;

use App\Forms\SubscriptionForm;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function form(): SubscriptionForm
    {
        return new SubscriptionForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'source' => 'required',
            'owner'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'owner.required' => 'Please type the Cardholder name',
        ];
    }
}

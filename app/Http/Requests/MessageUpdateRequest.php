<?php

namespace App\Http\Requests;

use App\Forms\MessageForm;
use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
{
    public function form(): MessageForm
    {
        return new MessageForm($this);
    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
           'subject' => 'nullable',
           'message' => 'nullable',
           'visualized' => 'required',
        ];
    }
}

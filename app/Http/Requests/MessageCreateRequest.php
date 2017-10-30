<?php

namespace App\Http\Requests;

use App\Forms\MessageForm;
use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
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
            'subject' => 'required',
            'message' => 'required',
            'visualized' => 'required',
        ];
    }
}

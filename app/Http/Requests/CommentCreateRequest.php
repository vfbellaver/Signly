<?php

namespace App\Http\Requests;

use App\Forms\CommentForm;

class CommentCreateRequest extends BaseRequest
{
    public function form(): CommentForm
    {
        return new CommentForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data = [
            'comment' => 'required'
        ];

        if( ! auth()->check() ) {
            $data['from_name'] = 'required';
        }

        return $data;
    }

    public function messages() 
    {
        return [
            'from_name.required' => 'The name is required.'
        ];
    }
}

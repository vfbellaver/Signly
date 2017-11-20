<?php

namespace App\Http\Requests;

use App\Forms\CommentForm;

class CommentUpdateRequest extends BaseRequest
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
        return [
			'team' => 'required|numeric',
			'user' => 'nullable|numeric',
			'from_name' => 'nullable',
			'comment' => 'required',
        ];
    }
}

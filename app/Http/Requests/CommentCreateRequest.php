<?php

namespace App\Http\Requests;

use App\Forms\CommentForm;
use Exception;

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

    protected function prepareForValidation()
    {
        $data = $this->all();
        if (!auth()->check()) {
            try {
                $data['proposal']['id'] = decrypt($data['proposal_id']);
            } catch (Exception $e) {
                $data['proposal'] = null;
            }
        }

        $this->replace($data);
        $this->request->replace($data);
        return $this->all();
    }

    public function rules()
    {
        $data = [
            'comment'  => 'required',
            'proposal' => 'required',
        ];

        if (!auth()->check()) {
            $data['from_name'] = 'required';
        }

        return $data;
    }

    public function messages()
    {
        return [
            'from_name.required' => 'The name field is required.',
        ];
    }
}

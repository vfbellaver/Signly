<?php

namespace App\Http\Requests;

use App\Forms\TeamForm;

class TeamUpdateRequest extends BaseRequest
{
    public function form(): TeamForm
    {
        return new TeamForm($this);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];
    }
}

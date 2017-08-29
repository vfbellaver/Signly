<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class ProposalSettingsFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'website' => 'required',
            'user_street' => 'required',
            'user_city' => 'required',
            'user_state' => 'required',
            'user_phone' => 'required',
            'user_zipcode' => 'required'
        ];
    }

    public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure
        // (default is to just redirect to initial page with errors)
        //
        // Can return a response, a view, a redirect, or whatever else
        return Response::make('Access denied', 403);
    }


}
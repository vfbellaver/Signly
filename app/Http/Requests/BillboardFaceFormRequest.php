<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class BillboardFaceFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'billboard_id' => 'required',
            'unique_id' => 'required',
            'height' => 'required',
            'width' => 'required',
            'reads' => 'required',
            'label' => 'required',
            'sign_type' => 'required',
            'hard_cost' => 'required',
            'monthly_impressions' => 'required',
            'notes' => 'required'
            
        ];
    }

    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }

    // OPTIONAL OVERRIDE
    public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure 
        // (default is to just redirect to initial page with errors)
        // 
        // Can return a response, a view, a redirect, or whatever else
        return Response::make('Access denied', 403);
    }

    // OPTIONAL OVERRIDE
    //storage function response()
    //{
        // If you want to customize what happens on a failed validation,
        // override this method.
        // See what it does natively here: 
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
    //}
}
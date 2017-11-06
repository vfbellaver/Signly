<?php

namespace App\Rules;

use Hash;
use Illuminate\Contracts\Validation\Rule;

class CurrentPassword implements Rule
{

    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        $user = auth()->user();
        return Hash::check($value, $user->password);
    }

    public function message()
    {
        return 'The :attribute is invalid.';
    }
}

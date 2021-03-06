<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordFormat implements Rule
{
    public function passes($attribute, $value)
    {
        $containsLetter = preg_match('/[a-zA-Z]/', $value);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $value);
        $containsUpper = preg_match('/[A-Z]/', $value);
        $length = strlen($value) >= 6;

        return $containsLetter && $containsUpper && $containsSpecial && $length;
    }

    public function message()
    {
        return "The password should have a minimum of 6 characters, 1 symbol (e.g. @, $, !), and 1 uppercase letter.";
    }
}

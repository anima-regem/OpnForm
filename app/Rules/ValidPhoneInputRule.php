<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidPhoneInputRule implements Rule
{
    public function passes($attribute, $value)
    {
        if (!is_string($value) || !Str::startsWith($value, '+')) {
            return false;
        }
        
        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            return $phoneUtil->isValidNumber($phoneUtil->parse($value));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return 'The :attribute is invalid.';
    }
}
<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;

class MobileNumber implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $result = $phoneUtil->parse($value, PhoneNumberFormat::INTERNATIONAL);
            if(PhoneNumberType::MOBILE != $phoneUtil->getNumberType($result)){
                $fail('The :attribute must be a valid mobile number.');
            };
        } catch (NumberParseException $e) {
            $fail('The :attribute must be a valid number.');
        }
    }
}

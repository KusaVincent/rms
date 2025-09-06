<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class ValidPhoneNumber implements ValidationRule
{
    public static function format(string $phoneNumber): string
    {
        $cleaned = preg_replace('/\D+/', '', $phoneNumber);
        $length = mb_strlen((string) $cleaned);

        if ($length < 7 || $length > 25) {
            return '';
        }

        $countryCode = '254';

        if (str_starts_with((string) $cleaned, '254')) {
            $number = mb_substr((string) $cleaned, 3);
        } elseif (str_starts_with((string) $cleaned, '07')) {
            $number = mb_substr((string) $cleaned, 1);
        } elseif (str_starts_with((string) $cleaned, '7') && $length === 9) {
            $number = $cleaned;
        } else {
            return ctype_digit((string) $cleaned) ? $cleaned : '';
        }

        if (! ctype_digit((string) $number) || mb_strlen($number) !== 9) {
            return '';
        }

        return $countryCode.$number;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $formatted = self::format($value);

        if ($formatted === '') {
            $fail('The :attribute must be a valid phone number.');
        }
    }
}

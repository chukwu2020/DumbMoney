<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BlockDisposableEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = substr(strrchr($value, "@"), 1);

        $blockedDomains = config('blocked_emails.domains', []);

        if (in_array(strtolower($domain), $blockedDomains)) {
            $fail('Disposable or temporary email addresses are not allowed.');
        }
    }
}
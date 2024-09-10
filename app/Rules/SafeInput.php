<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SafeInput implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Perform your regex check here
        return preg_match('/^((?!script>|<script|alert|javascript|prompt|onerror|document.cookie).)*$/si', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field contains invalid characters.';
    }
}

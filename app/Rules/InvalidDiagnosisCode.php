<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InvalidDiagnosisCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!($value >= 'A000' && $value <= 'Z999')) {
            return false;
        }

        if ($value >= 'A000' && $value <= 'A014') {
            return false;
        }

        if ($value >= 'X000' && $value <= 'X999') {
            return false;
        }

        if ($value >= 'Y000' && $value <= 'Y980') {
            return false;
        }

        if ($value >= 'V010' && $value <= 'V999') {
            return false;
        }

        if ($value >= 'W001' && $value <= 'W999') {
            return false;
        }

        if ($value >= 'X001' && $value <= 'X999') {
            return false;
        }

        if ($value >= 'Y001' && $value <= 'Y989') {
            return false;
        }

        if ($value >= 'B950' && $value <= 'B978') {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Diagnosis Code';
    }
}

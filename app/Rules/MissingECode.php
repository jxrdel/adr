<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MissingECode implements Rule
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
        $data = request()->all(); // Get all request data
        $diagnosis = $data['adDiagnosis1_Block'];
        $firstLetter = substr($diagnosis, 0, 1);

        if ($firstLetter === 'S' && ($value === '' || $value <= 0)) {
            return false;
        }

        if ($firstLetter === 'T' && ($value === '' || $value <= 0)) {
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
        return 'Missing E-Code.';
    }
}

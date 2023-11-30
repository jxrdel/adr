<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GenderDiagnosis implements Rule
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
        $sex = $data['adSexID'];

        //For real validation, concatenate Diagnosis 1 + Diagnosis 1 Block, then replace $value with concatenated value
        //$string = $value . $sex;
        //dd($string);

        //Put below in InvalidCode Rule
        // if ($value >= 'A500' && $value <= 'B518') {
        //     return false;
        // }

        if ($value >= 'N400' && $value <= 'N518' && $sex === 'Female') {
            return false;
        }

        if ($value >= 'C510' && $value <= 'C580' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'C600' && $value <= 'C639' && $sex === 'Female') {
            return false;
        }

        if ($value >= 'N700' && $value <= 'N989' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'O001' && $value <= 'O998' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'D060' && $value <= 'D073' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'N400' && $value <= 'N518' && $sex === 'Female') {
            return false;
        }

        if ($value >= 'D074' && $value <= 'D076' && $sex === 'Female') {
            return false;
        }

        if ($value >= 'Z300' && $value <= 'Z309' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'D290' && $value <= 'D299' && $sex === 'Female') {
            return false;
        }

        if ($value >= 'D250' && $value <= 'D289' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'Z320' && $value <= 'Z379' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'Z390' && $value <= 'Z392' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'Q500' && $value <= 'Q529' && $sex === 'Male') {
            return false;
        }

        if ($value >= 'Q530' && $value <= 'Q559' && $sex === 'Female') {
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
        return 'Gender incompatible with Diagnosis 1';
    }
}

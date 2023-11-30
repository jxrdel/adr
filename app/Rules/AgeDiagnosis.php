<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class AgeDiagnosis implements Rule
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
        $dob = $data['adDateOfBirth'];
        $doa = $data['adDateOfAdmission'];
        $age = $this->getAgeAtAdmission($dob, $doa);
        $years = $age['years'];
        $months = $age['months'];


        if (!($years === 0 && $months === 0)) {
            if ($value >= 'P000' && $value <= 'P969') {
                return false;
            }
        }

        if ($value >= 'N600' && $value <= 'N999' && $years < 15) {
            return false;
        }

        if ($value >= 'O000' && $value <= 'O998' && $years < 12) {
            return false;
        }

        if ($value >= 'O000' && $value <= 'O998' && $years > 50) {
            return false;
        }

        if ($value === 'R540' && $years < 65) {
            return false;
        }

        if (!($years === 0 && $months === 0)) {
            if ($value >= 'Z380' && $value <= 'Z388') {
                return false;
            }
        }

        if ($value >= 'Z340' && $value <= 'Z369' && $years < 15) {
            return false;
        }

        if ($value >= 'N910' && $value <= 'N929' && $years < 5) {
            return false;
        }

        if ($value >= 'N910' && $value <= 'N929' && $years > 64) {
            return false;
        }

        if ($value >= 'N950' && $value <= 'N959' && $years < 40) {
            return false;
        }

        if ($value >= 'N970' && $value <= 'N979' && $years < 15) {
            return false;
        }

        if ($value >= 'N970' && $value <= 'N979' && $years > 15) {
            return false;
        }

        // if ($value >= 'P000' && $value <= 'P969' && ($years = 0 && $months = 0)) {
        //     return false;
        // }

        return true;
    }

    public function getAgeAtAdmission($dob, $doa)
    {
        $dob = Carbon::parse($dob);
        $doa = Carbon::parse($doa);

        $yearsDiff = $dob->diffInYears($doa);
        $monthsDiff = $dob->diffInMonths($doa) % 12;

        $response = [
            'years' => $yearsDiff,
            'months' => $monthsDiff,
        ];

        return $response;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Age incompatible with Diagnosis';
    }
}

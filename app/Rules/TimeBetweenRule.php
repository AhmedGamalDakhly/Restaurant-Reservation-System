<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class TimeBetweenRule implements Rule
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
        $choosenValue= Carbon::parse($value);
        $choosenTime= Carbon::createFromTime($choosenValue->hour,$choosenValue->minute,$choosenValue->second);
        $openTime = Carbon::createFromTimeString('14:00:00');
        $closeTime = Carbon::createFromTimeString('22:00:00');
        return $choosenTime->between($openTime ,$closeTime) ;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose valid time (from 14:00 to 22:00 )';
    }
}

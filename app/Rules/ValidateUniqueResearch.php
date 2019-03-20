<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Research;
use Auth;

class ValidateUniqueResearch implements Rule
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
        $count = Research::where('name', $value)->where('user_id', Auth::user()->id)->count();
        return $count == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le name a déjà été pris.';
    }
}

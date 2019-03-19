<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckMineTypeRule implements Rule
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
        if(!$value) {
            return true;
        }
        $path_info = pathinfo($value);
        if(empty($path_info)) {
            return false;
        }
        if(array_key_exists('extension', $path_info)) {
            switch ($path_info['extension']) {
                case 'png':
                    return true;
                    break;
                case 'jpg':
                    return true;
                    break;
                case 'gif':
                    return true;
                    break;
                case 'svg':
                    return true;
                    break;
                default:
                    return false;
                    break;    
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'le fichier doit être une image';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckRssRule implements Rule
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

        try {
            $doc = new \DOMDocument();
            $doc->load($value);

            $rss = $doc->getElementsByTagName('rss');
            if($rss->length == 1) {
                $version = $doc->getElementsByTagName('rss')->item(0)->getAttribute('version');
                if($version != '2.0') {
                    return false;
                }

            } else {
                return false;
            }

        } catch (\Exception $ex) {
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
        return 'Le format de lien rss est invalide.';
    }
}

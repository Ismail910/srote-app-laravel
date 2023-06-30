<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{

    protected $forbidden;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function __construct($forbidden ){
        $this->forbidden =  array_map('strtolower', $forbidden);
    }
     public function passes($attribute, $value)
    {
        return ! in_array( strtolower($value) , $this->forbidden);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'This name is not allowed!';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AdminAccessRule implements Rule
{

    private bool $main;
    private bool $is_belongs;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(bool $main, bool $is_belongs)
    {
        $this->main = $main;
        $this->is_belongs = $is_belongs;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->main == $this->is_belongs or $this->main;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute not accessible for this admin';
    }
}

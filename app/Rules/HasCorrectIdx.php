<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasCorrectIdx implements Rule
{
    /**
     * @var int
     */
    private $startIdx;

    /**
     * Create a new rule instance.
     * @param int|null $startIdx
     *
     * @return void
     */
    public function __construct(?int $startIdx)
    {
        $this->startIdx = (int)$startIdx;
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
        return $this->startIdx === 0 || $value >= $this->startIdx;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

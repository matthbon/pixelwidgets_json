<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasConsecutive implements Rule
{
    /**
     * @var int
     */
    private $numberOfConsecutive;

    /**
     * Create a new rule instance.
     * @param int $numberOfConsecutive
     *
     * @return void
     */
    public function __construct(int $numberOfConsecutive = 3)
    {
        $this->numberOfConsecutive = $numberOfConsecutive;
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
        $arrayNumbers = str_split($value);
        $consecutive = 0;
        $prev = null;
        foreach ($arrayNumbers as $arrayNumber) {
            if ($prev !== null) {
                $t = (int)$arrayNumber - (int)$prev;
                if ($t === 1) {
                    $consecutive++;
                } elseif ($consecutive > 0) {
                    $consecutive--;
                }
            }
            $prev = $arrayNumber;

            if ($consecutive === $this->numberOfConsecutive) {
                return true;
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
        return 'The validation error message.';
    }
}

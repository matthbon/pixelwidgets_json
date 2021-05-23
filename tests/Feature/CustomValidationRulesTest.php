<?php

namespace Tests\Feature;

use App\Rules\HasConsecutive;
use App\Rules\HasCorrectIdx;
use App\Rules\ValidAge;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CustomValidationRulesTest extends TestCase
{
    /**
     * Test that correct idx is true
     */
    public function testHasCorrectIdx(): void
    {
        $rules = ['idx' => [new HasCorrectIdx(1)]];
        $data = ['idx' => 2];

        $v = Validator::make($data, $rules);
        self::assertTrue($v->passes());
    }

    /**
     * Test that correct idx is false
     */
    public function testHasNotCorrectIdx(): void
    {
        $rules = ['idx' => [new HasCorrectIdx(1)]];
        $data = ['idx' => 0];

        $v = Validator::make($data, $rules);
        self::assertNotTrue($v->passes());
    }

    /**
     * Test that correct date of birth is valid age
     */
    public function testDateOfBirthIsValidAge(): void
    {
        $rules = ['date_of_birth' => [new ValidAge()]];
        $data = ['date_of_birth' => '22-04-1983'];

        $v = Validator::make($data, $rules);
        self::assertTrue($v->passes());
    }

    /**
     * Test that correct date of birth is not a valid age
     */
    public function testDateOfBirthIsNoValidAge(): void
    {
        $rules = ['date_of_birth' => [new ValidAge()]];
        $data = ['date_of_birth' => '22-04-2020'];

        $v = Validator::make($data, $rules);
        self::assertNotTrue($v->passes());
    }

    /**
     * Test that correct date of birth is not a valid age
     */
    public function testDateOfBirthIsNoValidDate(): void
    {
        $rules = ['date_of_birth' => [new ValidAge()]];
        $data = ['date_of_birth' => '15/09/1978'];

        $v = Validator::make($data, $rules);
        self::assertTrue($v->passes());
    }

    /**
     * Test that correct idx is true
     */
    public function testHasConsecutiveInCreditCardNumber(): void
    {
        $rules = ['credit_card.number' => [new HasConsecutive()]];
        // Has 345 in it so passes
        $data = ['credit_card' => ['number' => '4532383456470']];

        $v = Validator::make($data, $rules);
        self::assertTrue($v->passes());
    }

    /**
     * Test that correct idx is false
     */
    public function testHasNoConsecutiveInCreditCardNumber(): void
    {
        $rules = ['credit_card.number' => [new HasConsecutive()]];
        $data = ['credit_card' => ['number' => '4532383564703']];

        $v = Validator::make($data, $rules);
        self::assertNotTrue($v->passes());
    }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Validator\InputValidator;

final class InputValidatorTest extends TestCase
{
    private InputValidator $validator;

    public function setUp(): void
    {
        $this->validator = new InputValidator();
    }

    public function testIsSpaceDelimitedValidation()
    {
        $this->assertTrue($this->validator->isSpaceDelimited('2'));
        $this->assertTrue($this->validator->isSpaceDelimited('+'));
        $this->assertTrue($this->validator->isSpaceDelimited('2 4 6 8 + + -'));
    }

    public function testHasNumbersOrValidOperatorsValidation()
    {
        $this->assertTrue($this->validator->hasNumbersOrValidOperators('2'));
        $this->assertTrue($this->validator->hasNumbersOrValidOperators('+'));
        $this->assertTrue($this->validator->hasNumbersOrValidOperators('2 4 6 + + -'));
        $this->assertFalse($this->validator->hasNumbersOrValidOperators('a 2 b - ^'));
    }

    public function testAreOperatorsPrecededByNumbersValidation()
    {
        $this->assertTrue($this->validator->areOperatorsPrecededByNumbers('2'));
        $this->assertTrue($this->validator->areOperatorsPrecededByNumbers('+'));
        $this->assertTrue($this->validator->areOperatorsPrecededByNumbers('2 4 6 + + -'));
        $this->assertFalse($this->validator->areOperatorsPrecededByNumbers('2 4 6 + 8 -'));
    }
}
<?php

namespace Validator;

use Calculator\OperatorQueue;

class InputValidator
{
    private $errors = [];

    public function clearErrors()
    {
        $this->errors = [];
    }

    public function isSpaceDelimited($input) : bool
    {
        $inputArray = explode(' ', $input);

        if (count($inputArray) == 1) {
            return true;
        }

        if (preg_match('/^[^ ].* .*[^ ]$/', $input)) {
            return true;
        }

        $this->errors[] = 'Input must be separated by spaces.';

        return false;
    }

    public function hasNumbersOrValidOperators($input) : bool
    {
        $inputArray = explode(' ', $input);

        foreach ($inputArray as $item) {
            if ($this->isNumberOrValidOperator($item)) {
                continue;
            } else {
                $this->errors[] = 'Input must contain numbers and valid operators (' . implode(' ', $this->getValidOperators()) . ')';
                return false;
            }
        }

        return true;
    }

    public function areOperatorsPrecededByNumbers($input): bool
    {
        $inputArray = explode(' ', $input);

        if (count($inputArray) == 1 && ($this->isNumberOrValidOperator($inputArray[0]))) {
            return true;
        }

        for ($i=0; $i<count($inputArray) - 2; $i++) {
            if (is_numeric($inputArray[$i]) && in_array($inputArray[$i+1], $this->getValidOperators()) && is_numeric($inputArray[$i+2])) {
                $this->errors[] = 'Input must have numbers followed by operators.';
                return false;
            }
        }

        return true;
    }

    private function isNumberOrValidOperator($item)
    {
        if (is_numeric($item) || in_array($item, $this->getValidOperators())) {
            return true;
        }

        return false;
    }

    private function getValidOperators()
    {
        $operatorQueue = new OperatorQueue();

        return $operatorQueue->getValidOperators();
    }

    public function validate($input)
    {
        $this->isSpaceDelimited($input);
        $this->isNumberOrValidOperator($input);
        $this->areOperatorsPrecededByNumbers($input);

        return $this->errors;
    }


}
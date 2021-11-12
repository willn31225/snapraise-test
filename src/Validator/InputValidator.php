<?php

namespace Validator;

use Calculator\OperatorQueue;

class InputValidator
{
    private $errors;

    public function isSpaceDelimited($input) : bool
    {
        $inputArray = explode(' ', $input);

        if (count($inputArray) == 1) {
            return true;
        }

        if (preg_match('/^[^ ].* .*[^ ]$/', $input)) {
            return true;
        }

        return false;
    }

    public function hasNumbersOrValidOperators($input) : bool
    {
        $inputArray = explode(' ', $input);

        foreach ($inputArray as $item) {
            if ($this->isNumberOrValidOperator($item)) {
                continue;
            } else {
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

        $operatorQueue = new OperatorQueue();

        for ($i=0; $i<count($inputArray) - 2; $i++) {
            if (is_numeric($inputArray[$i]) && in_array($inputArray[$i+1], $operatorQueue->getValidOperators()) && is_numeric($inputArray[$i+2])) {
                return false;
            }
        }

        return true;
    }

    private function isNumberOrValidOperator($item)
    {
        $operatorQueue = new OperatorQueue();

        if (is_numeric($item) || in_array($item, $operatorQueue->getValidOperators())) {
            return true;
        }

        return false;
    }

    public function validate($input)
    {
        $this->isSpaceDelimited($input);
        $this->isNumberOrValidOperator($input);
        $this->areOperatorsPrecededByNumbers($input);

        return $this->errors;
    }
}
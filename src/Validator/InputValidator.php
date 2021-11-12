<?php

namespace Validator;

use Calculator\OperatorQueue;

class InputValidator
{
    private $errors = [];

    /**
     * @returns void
     */
    public function clearErrors(): void
    {
        $this->errors = [];
    }

    /**
     * @param $input
     * @return bool
     */
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

    /**
     * @param $input
     * @return bool
     */
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

    /**
     * @param $input
     * @return bool
     */
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

    /**
     * @param $item
     * @return bool
     */
    private function isNumberOrValidOperator($item)
    {
        if (is_numeric($item) || in_array($item, $this->getValidOperators())) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    private function getValidOperators(): array
    {
        $operatorQueue = new OperatorQueue();

        return $operatorQueue->getValidOperators();
    }

    /**
     * @param $input
     * @return array
     */
    public function validate($input)
    {
        $this->isSpaceDelimited($input);
        $this->isNumberOrValidOperator($input);
        $this->areOperatorsPrecededByNumbers($input);

        return $this->errors;
    }


}
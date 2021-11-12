<?php

class InputValidator
{
    private $errors;

    public function isSpaceDelimited($input)
    {

    }

    public function isNumberOrValidOperator($input)
    {

    }

    public function areOperatorsPrecededByNumbers($input)
    {

    }

    public function validate($input)
    {
        $this->isSpaceDelimited($input);
        $this->isNumberOrValidOperator($input);
        $this->areOperatorsPrecededByNumbers($input);

        return $this->errors;
    }
}
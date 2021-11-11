<?php

namespace Calculator;

class NumberStack
{
    private $stack;

    /**
     * @returns void
     */
    public function init()
    {
        $this->stack = [];
    }

    /**
     * @returns void
     */
    public function push($number)
    {
        $this->stack[] = $number;
    }

    /**
     * @returns int|float
     */
    public function pop()
    {
        return array_pop($this->stack);
    }

    /**
     * @returns int|float
     */
    public function top() : bool
    {
        return current($this->stack);
    }

    /**
     * @returns bool
     */
    public function isEmpty()
    {
        return empty($this->stack);
    }
}
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
     * @returns int|float|null
     */
    public function top()
    {
        if (!$this->isEmpty()) {
            return current($this->stack);
        }

        return null;
    }

    /**
     * @returns bool
     */
    public function isEmpty()
    {
        return empty($this->stack);
    }
}
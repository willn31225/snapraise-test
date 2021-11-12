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
     * @returns int
     */
    public function getCount(): int
    {
        return count($this->stack);
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
            return end($this->stack);
        }

        return null;
    }

    /**
     * @returns string
     */
    public function show()
    {
        return implode(' ', $this->stack);
    }

    /**
     * @returns bool
     */
    public function isEmpty()
    {
        return empty($this->stack);
    }
}
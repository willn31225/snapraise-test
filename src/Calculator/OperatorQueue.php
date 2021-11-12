<?php

namespace Calculator;

class OperatorQueue
{
    private $queue;

    /**
     * @return Array
     */
    public function getValidOperators(): Array
    {
        return ['+', '-', '*', '/'];
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->queue);
    }

    /**
     * @returns void
     */
    public function init()
    {
        $this->queue = [];
    }

    /**
     * @returns void
     */
    public function enqueue($operator)
    {
        $this->queue[] = $operator;
    }

    /**
     * @returns string
     */
    public function dequeue()
    {
        return array_shift($this->queue);
    }

    /**
     * @returns string
     */
    public function peek()
    {
        if (!$this->isEmpty()) {
            return $this->queue[0];
        }

        return null;
    }

    /**
     * @returns string
     */
    public function show()
    {
        return implode(' ', $this->queue);
    }

    /**
     * @returns bool
     */
    public function isEmpty() : bool
    {
        return empty($this->queue);
    }
}
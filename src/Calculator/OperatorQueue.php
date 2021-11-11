<?php

namespace Calculator;

class OperatorQueue
{
    private $queue;

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
     * @returns bool
     */
    public function isEmpty() : bool
    {
        return empty($this->queue);
    }
}
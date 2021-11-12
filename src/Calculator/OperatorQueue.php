<?php

namespace Calculator;

class OperatorQueue
{
    private $queue;

    public function getValidOperators()
    {
        return ['+', '-', '*', '/'];
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
     * @returns bool
     */
    public function isEmpty() : bool
    {
        return empty($this->queue);
    }
}
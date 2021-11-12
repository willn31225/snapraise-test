<?php

namespace Parser;

use Calculator\NumberStack;
use Calculator\OperatorQueue;

class InputParser
{
    /**
     * @param $input
     * @param NumberStack $stack
     * @returns void
     */
    public function parseInputForNumbers($input, NumberStack $stack): void
    {
        $inputArray = explode(' ', $input);

        foreach ($inputArray as $item) {
            if (is_numeric($item)) {
                $stack->push($item);
            }
        }
    }

    /**
     * @param $input
     * @param OperatorQueue $queue
     * @returns void
     */
    public function parseInputForOperators($input, OperatorQueue $queue): void
    {
        $inputArray = explode(' ', $input);

        foreach ($inputArray as $item) {
            if (in_array($item, $queue->getValidOperators())) {
                $queue->enqueue($item);
            }
        }
    }
}
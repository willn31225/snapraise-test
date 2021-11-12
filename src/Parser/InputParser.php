<?php

namespace Parser;

use Calculator\NumberStack;
use Calculator\OperatorQueue;

class InputParser
{
    public function parseInputForNumbers($input, NumberStack $stack): void
    {
        $inputArray = explode(' ', $input);

        foreach ($inputArray as $item) {
            if (is_numeric($item)) {
                $stack->push($item);
            }
        }
    }

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
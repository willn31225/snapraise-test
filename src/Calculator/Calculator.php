<?php

namespace Calculator;

use IO\IOInterface;
use Validator\InputValidator;
use Parser\InputParser;

class Calculator
{
    private IOInterface $io;
    private NumberStack $stack;
    private OperatorQueue $queue;
    private InputValidator $validator;
    private InputParser $parser;

    public function __construct(IOInterface $io)
    {
        $this->io = $io;

        $this->validator = new InputValidator();
        $this->parser = new InputParser();

    }

    public function exec()
    {
        $stack = new NumberStack();
        $queue = new OperatorQueue();

        $stack->init();
        $queue->init();

        while (true) {
            $input = $this->io->input();
            $this->validator->validate($input);

            $this->parser->parseInputForNumbers($input, $stack);
            $this->parser->parseInputForOperators($input, $queue);

            $this->calc($stack, $queue);

            echo $stack->top() . PHP_EOL;
        }
    }

    public function calc(NumberStack $stack, OperatorQueue $queue)
    {
        /*if ($stack->getCount() < 2) {
            $queue->dequeue();
            echo 'Must have at least 2 numbers to perform calculation.';
            return true;
        }*/

        if ($queue->isEmpty()) {
            return true;
        }

        while (!$queue->isEmpty()) {
            $operator = $queue->dequeue();
            $x = $stack->pop();
            $y = $stack->pop();

            switch ($operator) {
                case '+':
                    $stack->push($x+$y);
                    break;
                case '-':
                    $stack->push($x-$y);
                    break;
                case '*':
                    $stack->push($x*$y);
                    break;
                case '/':
                    $stack->push($x/$y);
                    break;
            }
        }

        //echo $stack->top() . PHP_EOL;

        return true;
    }
}
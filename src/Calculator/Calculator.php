<?php

namespace Calculator;

use IO\IOInterface;
use Validator\InputValidator;
use Parser\InputParser;

class Calculator
{
    private IOInterface $io;
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

            if ($input == 'q') {
                $this->io->exit();
            }

            $errors = $this->validator->validate($input);

            if ($errors) {
                foreach ($errors as $error) {
                    echo $error . PHP_EOL;
                }
                $this->validator->clearErrors();
                continue;
            }

            $this->parser->parseInputForNumbers($input, $stack);
            $this->parser->parseInputForOperators($input, $queue);

            $this->calc($stack, $queue);

            echo $stack->top() . PHP_EOL;
        }
    }

    public function calc(NumberStack $stack, OperatorQueue $queue): bool
    {
        if ($queue->isEmpty()) {
            return true;
        }

        while (!$queue->isEmpty()) {
            $operator = $queue->dequeue();
            $y = $stack->pop();
            $x = $stack->pop();

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

        return true;
    }
}
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

    /**
     * @param IOInterface $io
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;

        $this->validator = new InputValidator();
        $this->parser = new InputParser();
    }

    /**
     * @returns void
     */
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
                    $this->io->output($error);
                }
                $this->validator->clearErrors();
                continue;
            }

            $this->parser->parseInputForNumbers($input, $stack);
            $this->parser->parseInputForOperators($input, $queue);

            if ($stack->getCount() < 2 && !$queue->isEmpty()) {
                $this->io->output('Must have at least 2 numbers to perform calculation.');
            }

            $this->calc($stack, $queue);

            $this->io->output($stack->top());
        }
    }

    /**
     * @param NumberStack $stack
     * @param OperatorQueue $queue
     * @return bool
     */
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
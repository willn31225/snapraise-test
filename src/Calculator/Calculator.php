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
        $this->stack = new NumberStack();
        $this->queue = new OperatorQueue();
        $this->validator = new InputValidator();
        $this->parser = new InputParser();

        $this->stack->init();
        $this->queue->init();
    }

    public function exec()
    {
        $input = $this->io->input();
        $this->validator->validate($input);

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $this->calc();
    }

    public function calc()
    {

    }
}
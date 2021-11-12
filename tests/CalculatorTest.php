<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IO\CLI;
use Calculator\Calculator;
use Calculator\NumberStack;
use Calculator\OperatorQueue;
use Parser\InputParser;

final class CalculatorTest extends TestCase
{
    private Calculator $calculator;
    private NumberStack $stack;
    private OperatorQueue $queue;
    private InputParser $parser;

    public function setUp(): void
    {
        $this->calculator = new Calculator(new CLI());
        $this->stack = new NumberStack();
        $this->queue = new OperatorQueue();
        $this->parser = new InputParser();
    }

    public function testCalculation()
    {
        $this->stack->init();
        $this->queue->init();

        $input = '8 5 8 + +';

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $successful = $this->calculator->calc($this->stack, $this->queue);

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(21, $this->stack->top());

        $input = '8';

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $successful = $this->calculator->calc($this->stack, $this->queue);

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(8, $this->stack->top());

        $input = '+';

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $successful = $this->calculator->calc($this->stack, $this->queue);

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(29, $this->stack->top());

        $input = '-';

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $successful = $this->calculator->calc($this->stack, $this->queue);

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(29, $this->stack->top());

        $input = '8 -';

        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        $successful = $this->calculator->calc($this->stack, $this->queue);

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-21, $this->stack->top());
    }
}
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

    public function testCalculationDefault()
    {
        $this->stack->init();
        $this->queue->init();

        $successful = $this->calc('8 5 8 + +');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(21, $this->stack->top());

        $successful = $this->calc('8');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(8, $this->stack->top());

        $successful = $this->calc('+');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(29, $this->stack->top());

        $successful = $this->calc('-');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-29, $this->stack->top());

        $successful = $this->calc('8 -');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-37, $this->stack->top());
    }

    public function testFirstCase()
    {
        $this->stack->init();
        $this->queue->init();

        $successful = $this->calc('5');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(5, $this->stack->top());

        $successful = $this->calc('8');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(8, $this->stack->top());

        $successful = $this->calc('+');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(13, $this->stack->top());
    }

    public function testSecondCase()
    {
        $this->stack->init();
        $this->queue->init();

        $successful = $this->calc('5 5 5 8 + + -');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-13, $this->stack->top());

        $successful = $this->calc('13 +');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(0, $this->stack->top());
    }

    public function testThirdCase()
    {
        $this->stack->init();
        $this->queue->init();

        $successful = $this->calc('-3');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-3, $this->stack->top());

        $successful = $this->calc('-2');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(-2, $this->stack->top());

        $successful = $this->calc('*');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(6, $this->stack->top());

        $successful = $this->calc('5');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(5, $this->stack->top());

        $successful = $this->calc('+');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(11, $this->stack->top());
    }

    public function testFourthCase()
    {
        $this->stack->init();
        $this->queue->init();

        $successful = $this->calc('5');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(5, $this->stack->top());

        $successful = $this->calc('9');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(9, $this->stack->top());

        $successful = $this->calc('1');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(1, $this->stack->top());

        $successful = $this->calc('-');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(8, $this->stack->top());

        $successful = $this->calc('/');

        $this->assertTrue($successful);
        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals(0.625, $this->stack->top());
    }

    private function calc($input)
    {
        $this->parser->parseInputForNumbers($input, $this->stack);
        $this->parser->parseInputForOperators($input, $this->queue);

        return $this->calculator->calc($this->stack, $this->queue);
    }
}
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Parser\InputParser;
use Calculator\NumberStack;
use Calculator\OperatorQueue;

final class InputParserTest extends TestCase
{
    private InputParser $parser;
    private NumberStack $stack;
    private OperatorQueue $queue;

    public function setUp(): void
    {
        $this->parser = new InputParser();
        $this->stack = new NumberStack();
        $this->queue = new OperatorQueue();
    }

    public function testParseNumbers()
    {
        $this->stack->init();
        $this->parser->parseInputForNumbers('8 8 8 + +', $this->stack);

        $this->assertEquals(3, $this->stack->getCount());
        $this->assertEquals(8, $this->stack->top());
    }

    public function testParseOperators()
    {
        $this->queue->init();
        $this->parser->parseInputForOperators(' 8 5 8 2 + - +', $this->queue);

        $this->assertEquals(3, $this->queue->getCount());
        $this->assertEquals('+', $this->queue->peek());
    }
}
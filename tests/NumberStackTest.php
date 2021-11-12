<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Calculator\NumberStack;

final class NumberStackTest extends TestCase
{
    private NumberStack $stack;

    public function setUp(): void
    {
        $this->stack = new NumberStack();
    }

    public function testPush(): void
    {
        $this->stack->init();

        $this->stack->push(2);

        $this->assertFalse($this->stack->isEmpty());
        $this->assertEquals(2, $this->stack->top());
    }

    public function testPop(): void
    {
        $this->stack->init();

        $this->stack->push(2);
        $this->stack->push(4);

        $number = $this->stack->pop();

        $this->assertFalse($this->stack->isEmpty());
        $this->assertEquals(4, $number);
        $this->assertEquals(2, $this->stack->top());

        $number = $this->stack->pop();
        $this->assertTrue($this->stack->isEmpty());
        $this->assertEquals(2, $number);

    }
}
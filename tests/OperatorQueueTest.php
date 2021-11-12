<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Calculator\OperatorQueue;

final class OperatorQueueTest extends TestCase
{
    private OperatorQueue $queue;

    public function setUp(): void
    {
        $this->queue = new OperatorQueue();
    }

    public function testEnqueue(): void
    {
        $this->queue->init();

        $this->queue->enqueue('+');

        $this->assertFalse($this->queue->isEmpty());
        $this->assertEquals('+', $this->queue->peek());
    }

    public function testDequeue(): void
    {
        $this->queue->init();

        $this->queue->enqueue('+');
        $this->queue->enqueue('-');

        $operator = $this->queue->dequeue();

        $this->assertFalse($this->queue->isEmpty());
        $this->assertEquals('+', $operator);
        $this->assertEquals('-', $this->queue->peek());

        $operator = $this->queue->dequeue();

        $this->assertTrue($this->queue->isEmpty());
        $this->assertEquals('-', $operator);
    }
}
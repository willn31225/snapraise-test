<?php

namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Calculator\Calculator;
use Calculator\OperatorQueue;
use IO\CLI;

class CalculatorCommand extends SymfonyCommand
{

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    public function configure()
    {
        $this->setName('calculator')
            ->setDescription('Allows for calculations in reverse polish notation');
    }

    public function execute(InputInterface $input, OutputInterface $output)    {
        $queue = new OperatorQueue();
        echo "Welcome to the RPN Calculator. Valid operators are " . implode(' ', $queue->getValidOperators()) . PHP_EOL;

        $calculator = new Calculator(new CLI());
        $calculator->exec();
        return 0;
    }
}
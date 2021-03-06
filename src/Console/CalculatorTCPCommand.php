<?php

namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Calculator\Calculator;
use Calculator\OperatorQueue;
use IO\TCP;

class CalculatorTCPCommand extends SymfonyCommand
{

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    public function configure()
    {
        $this->setName('tcp')
            ->setDescription('Allows for calculations in reverse polish notation via TCP connection');
    }

    public function execute(InputInterface $input, OutputInterface $output)    {
        $calculator = new Calculator(new TCP());
        $calculator->exec();
        return 0;
    }
}
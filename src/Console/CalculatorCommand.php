<?php

namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Calculator\Calculator;
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
        $calculator = new Calculator(new CLI());
        $calculator->exec();
        return 0;
    }
}
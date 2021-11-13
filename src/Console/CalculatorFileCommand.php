<?php

namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Calculator\Calculator;
use Calculator\OperatorQueue;
use IO\File;

class CalculatorFileCommand extends SymfonyCommand
{

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    public function configure()
    {
        $this->setName('file')
            ->setDescription('Allows for calculations in reverse polish notation from file')
            ->addArgument('file', InputArgument::REQUIRED, 'File to be used for calculations');
    }

    public function execute(InputInterface $input, OutputInterface $output)    {
        $calculator = new Calculator(new File($input->getArgument('file')));
        $calculator->exec();
        return 0;
    }
}
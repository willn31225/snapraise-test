<?php

namespace Calculator;

use IO\IOInterface;

class Calculator
{
    private IOInterface $io;

    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    public function exec()
    {
        $this->io->input();
    }

    public function calc()
    {

    }
}
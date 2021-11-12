<?php

namespace IO;

use IO\IOInterface;

class CLI implements IOInterface
{
    public function input()
    {
        return readline(">");
    }

    public function output($output)
    {
        echo $output;
    }

    public function exit()
    {
        exit();
    }
}
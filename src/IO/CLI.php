<?php

namespace IO;

use IO\IOInterface;

class CLI implements IOInterface
{

    /**
     * @return false|string
     */
    public function input()
    {
        return readline(">");
    }

    /**
     * @param $output
     */
    public function output($output)
    {
        echo $output;
    }

    public function exit()
    {
        exit();
    }
}
<?php

namespace IO;

use IO\IOInterface;

class File implements IOInterface
{
    private $fileHandler;

    public function __construct(string $path)
    {
        $this->setupFileHandler($path);
    }

    /**
     * @return false|string
     */
    public function input()
    {
        return str_replace(["\n", "\r"], '', fgets($this->fileHandler));
    }

    /**
     * @param $output
     */
    public function output($output)
    {
        echo $output . PHP_EOL;
    }

    public function exit()
    {
        exit();
    }

    public function setupFileHandler($path)
    {
        $this->fileHandler = fopen($path, 'r');
    }

    public function closeFileHandler()
    {
        fclose($this->fileHandler);
    }

    public function __deconstruct()
    {
        $this->closeFileHandler();
    }

}

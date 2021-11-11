<?php

namespace IO;

interface IOInterface
{
    public function input();

    public function output($output);

    public function exit();
}
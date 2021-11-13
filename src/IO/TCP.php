<?php

namespace IO;

use IO\IOInterface;

class TCP implements IOInterface
{
    private $socket;
    private $messageSocket;

    public function __construct()
    {
        $this->setupTCPSocket();
    }

    /**
     * @return false|string
     */
    public function input()
    {
        $this->messageSocket = socket_accept($this->socket);
        $buffer = socket_read($this->messageSocket, 2048, PHP_NORMAL_READ);

        return str_replace(["\n", "\r"], '', $buffer);
    }

    /**
     * @param $output
     */
    public function output($output)
    {
        $output = $output . PHP_EOL;
        socket_write($this->messageSocket, $output, strlen($output));
    }

    public function exit()
    {
        $this->closeTCPSocket();
        exit();
    }

    private function setupTCPSocket()
    {
        set_time_limit(0);
        ob_implicit_flush();

        $address = '127.0.0.1';
        $port = 4001;

        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($this->socket, $address, $port);

        socket_listen($this->socket, 5);
    }

    private function closeTCPSocket()
    {
        socket_close($this->messageSocket);
        socket_close($this->socket);
    }
}
<?php

namespace RadAir;

class Logger
{
    private function log($level, $message)
    {
        $log = date('Y-m-d H:i:s') . " [$level] " . $message;
        file_put_contents('logs/' . date('Y-m-d') . '-log.txt', $log . PHP_EOL, FILE_APPEND);
    }

    public function info($message)
    {
        $this->log('INFO', $message);
    }

    public function warning($message)
    {
        $this->log('WARNING', $message);
    }

    public function error($message)
    {
        $this->log('ERROR', $message);
    }
}
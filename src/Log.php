<?php

/**
 * Created by PhpStorm.
 * User: maksymmoskvychev
 * Date: 8/13/15
 * Time: 4:13 PM
 */
class Log
{

    /**
     * @param array $data
     */
    public function append($data)
    {
        $logLine = serialize($data) . "\n";
        file_put_contents($this->getWalFilePath(), $logLine, FILE_APPEND);
    }

    /**
     * @return array
     */
    public function read()
    {
        $lines = file($this->getWalFilePath());
        $data = [];
        foreach ($lines as $logLine) {
            $data[] = unserialize($logLine);
        }

        return $data;
    }

    public function clean()
    {
        unlink($this->getWalFilePath());
        touch($this->getWalFilePath());
    }

    /**
     * @return string
     */
    protected function getWalFilePath()
    {
        return __DIR__ . '/../data/wal.log';
    }
}

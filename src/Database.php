<?php

/**
 * Created by PhpStorm.
 * User: maksymmoskvychev
 * Date: 8/13/15
 * Time: 4:11 PM
 */
class Database
{

    /**
     * @var Storage
     */
    protected $storage;

    /**
     * @var Log
     */
    protected $wal;

    /**
     * @param string $key
     * @param string $value
     */
    public function write($key, $value)
    {
        $data = [];
        $data[$key] = $value;
        $this->wal->append($data);
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function read($key)
    {
        //Read value from wal log
        $reversedWalData = array_reverse($this->wal->read());
        foreach ($reversedWalData as $lineData) {
            if (isset($lineData[$key])) {
                return $lineData[$key];
            }
        }

        //Read value from storage
        return $this->storage->getValue($key);
    }

    /**
     * Write all data from wal file into storage
     */
    public function checkpoint()
    {
        $walData = $this->wal->read();
        foreach ($walData as $lineData) {
            $this->storage->setValue(key($lineData), current($lineData));
        }
        $this->storage->flush();
        $this->wal->clean();
    }

    /**
     * @param Storage $storage
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Log $wal
     */
    public function setWal($wal)
    {
        $this->wal = $wal;
    }
}

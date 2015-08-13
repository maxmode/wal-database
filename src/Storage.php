<?php

/**
 * Created by PhpStorm.
 * User: maksymmoskvychev
 * Date: 8/13/15
 * Time: 3:47 PM
 */
class Storage
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @inheritdoc
     */
    public function getValue($key)
    {
        $this->ensureDataIsFetched();
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function setValue($key, $value)
    {
        $this->ensureDataIsFetched();
        $this->data[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function flush()
    {
        file_put_contents($this->getStorageFileName(), serialize($this->data));
    }

    /**
     *
     */
    protected function ensureDataIsFetched()
    {
        if (!$this->data) {
            $this->data = unserialize(file_get_contents($this->getStorageFileName()));
        }
    }

    /**
     * @return string
     */
    protected function getStorageFileName()
    {
        return __DIR__ . '/../data/storage';
    }
}

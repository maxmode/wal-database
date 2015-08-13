<?php
require dirname(__DIR__) . '/vendor/autoload.php';

while (1) {
    $start = microtime(true);
    for ($i = 1; $i < 10000; $i++) {
        $database = new Database();
        $database->setStorage(new Storage());
        $database->setWal(new Log());
        $key = mt_rand(1, 20000);
        $value = md5(mt_rand());
        $database->write($key, $value);
    }
    $end = microtime(true);
    $database->checkpoint();
    echo 'Inserted 10000 rows in ' . round($end - $start, 3) . "s \n";
}

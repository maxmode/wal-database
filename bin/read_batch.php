<?php
require dirname(__DIR__) . '/vendor/autoload.php';

while (1) {
    $start = microtime(true);
    for ($i = 1; $i < 100; $i++) {
        $database = new Database();
        $database->setStorage(new Storage());
        $database->setWal(new Log());
        $key = mt_rand(1, 20000);
        $database->read($key);
    }
    $end = microtime(true);
    $database->checkpoint();
    echo 'Read 100 rows in ' . round($end - $start, 3) . "s \n";
}

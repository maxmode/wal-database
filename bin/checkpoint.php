<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$database = new Database();
$database->setStorage(new Storage());
$database->setWal(new Log());

$database->checkpoint();

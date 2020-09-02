<?php

use Swoole\Coroutine as co;

$filename = __DIR__."/data.txt";
co::create(function () use ($filename) {
    $r = co::readFile($filename);
    var_dump($r);

    $p = co::writeFile($filename, "hello swoole! \n", FILE_APPEND);
    var_dump($p);
});

echo "Start".PHP_EOL;

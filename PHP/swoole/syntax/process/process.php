<?php

$process = new swoole_process(function (swoole_process $process) {
    $process->exec("/usr/local/bin/php", [__DIR__.'/../Server/HTTP.php']);
}, true);

$pid = $process->start();
echo $pid.PHP_EOL;

swoole_process::wait();

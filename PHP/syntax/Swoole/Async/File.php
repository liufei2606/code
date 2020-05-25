<?php

swoole_async_readfile( __DIR__ . '/data.txt', function($filename, $fileContent){
    echo "filename:" . $filename . PHP_EOL;
});

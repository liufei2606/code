<?php

swoole_async_readfile(__DIR__.'/data.txt', function ($filename, $filecontext) {
    echo "filename:".$filename.PHP_EOL;
});

<?php

/**
 * 延时任务
 */
Swoole\Runtime::enableCoroutine();

go(function () {
    echo "a";
    defer(function () {
        echo "~a \n";
    });
    echo "b";
    defer(function () {
        echo "~b";
    });
    sleep(1);
    echo "c \n";
});

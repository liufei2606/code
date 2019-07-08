<?php
/**
 * 并发执行
 */

\Swoole\Runtime::enableCoroutine();

go(function ()
{
    sleep(1);
    echo "b";
});

go(function ()
{
    sleep(2);
    echo "c \n";
});

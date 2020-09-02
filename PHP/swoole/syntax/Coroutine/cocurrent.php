<?php
/**
 * 并发执行
 */

\Swoole\Runtime::enableCoroutine();

// c1b1 非阻塞 同时执行
go(function () {
    sleep(2);
    echo "b1\n";
});

go(function () {
    sleep(1);
    echo "c1";
});

// bc 堵塞的，test2 已执行完，还是后面输出
function test1()
{
    sleep(2);
    echo "b";
}

function test2()
{
    sleep(1);
    echo "c \n";
}

test1();
test2();

$n = 4;
for ($i = 0; $i < $n; $i++) {
    go(function () use ($i) {
        Co::sleep(1);
        echo microtime(true).": hello $i \n";
    });
};
echo "hello main \n";
// time 遇到 IO阻塞 时发生调度, IO就绪时恢复运行 适合 IO密集型 的应用

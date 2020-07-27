<?php

// 间隔触发
$timer_id = swoole_timer_tick(300, function ($timer_id) {
    echo 'Cycle tick='.$timer_id.' 3000ms - '.date('Y-m-d H:i:s').PHP_EOL;
});

// 清除
swoole_timer_after(3000, function () use ($timer_id) {
    echo 'After tick='.$timer_id.' 3000ms - '.date('Y-m-d H:i:s').PHP_EOL;
    swoole_timer_clear($timer_id);
});

$count = 0;
\Swoole\Timer::tick(1000, function ($timerId, $count) {
    global $count;
    echo "Swoole Timer ".$count.PHP_EOL;
    $count++;
    if ($count == 3) {
        \Swoole\Timer::clear($timerId);
    }
}, $count);

<?php

// 每隔3000ms触发一次
$timer_id = swoole_timer_tick(300, function ($timer_id) {
    echo 'Cycle tick=' . $timer_id . ' 3000ms - ' .date('Y-m-d H:i:s') . PHP_EOL;
});

// 3000ms后执行此函数
swoole_timer_after(3000, function () use ($timer_id) {
    echo 'After tick=' . $timer_id . ' 3000ms - ' .date('Y-m-d H:i:s') . PHP_EOL;
    swoole_timer_clear($timer_id);
});

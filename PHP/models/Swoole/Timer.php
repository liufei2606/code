<?php

$timer_id = swoole_timer_tick(3000, function($timer_id){
	echo 'tick=' . $timer_id . ' 3000ms - ' .date('Y-m-d H:i:s') . '\n';
})

swoole_time_after(3000, function() use($timer_id){
	echo 'tick=' . $timer_id . ' 3000ms - ' .date('Y-m-d H:i:s') . '\n';
})
<?php

$redis = new Redis();

//订阅
echo "---- 订阅{$strChannel}这个频道，等待消息推送...----  <br/><br/>";
$redis->subscribe([$strChannel], 'callBackFun');
function callBackFun($redis, $channel, $msg)
{
    print_r([
        'redis'   => $redis,
        'channel' => $channel,
        'msg'     => $msg
    ]);
}

<?php

Swoole\Runtime::enableCoroutine(SWOOLE_HOOK_ALL);
Swoole\Runtime::enableCoroutine(SWOOLE_HOOK_CURL);

$n = 10;
while ($n--) {
    go(function () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.xinhuanet.com/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        if ($output === false) {
            echo "CURL Error:".curl_error($ch);
        }
        curl_close($ch);
        echo strlen($output)." bytes\n";
    });
}

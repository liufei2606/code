<?php

/*
 *     hash(i) = hash(i-1) * 33 + str[i]
 *     (hash << 5) + hash 相当于 hash * 33
 */

function djbx33a($str)
{
    $hash = 0;
    $s = md5($str);
    $seed = 5;
    $len = 32;
    for ($i = 0; $i < $len; $i++) {
        $hash = ($hash << $seed) + ord($s[$i]);
        echo $s[$i].'-'.ord($s[$i]).'-'.$hash.PHP_EOL;
        if ($i == 3) {
            die;
        }
    }

    return $hash & 0x7FFFFFFF;
}

echo djbx33a('sagasgerq54wqtgfdagfdhrda').PHP_EOL;

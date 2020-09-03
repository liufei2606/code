<?php

namespace Algorithms\sort;

abstract class AbstractSort
{
    abstract public static function sort(array $arr);

    public static function arraySwap(&$arr, $l, $r)
    {
        $arr[$l] ^= $arr[$r];
        $arr[$r] = $arr[$l] ^ $arr[$r];
        $arr[$l] ^= $arr[$r];
    }
}

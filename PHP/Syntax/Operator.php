<?php

// 指数
echo 2 ** 3 . PHP_EOL;

// 越靠前优先级越高
echo 0 ?: 1 ?: 2 ?: 3; //1
echo 0 ?: 0 ?: 2 ?: 3; //2
echo 0 ?: 0 ?: 0 ?: 3; //3
echo 0 ?: 4; // 4

$a = 36;
$b = 56;
$c = 67;
echo $a ?? $b ?? $c;
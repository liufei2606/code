<?php

/**
 *  大小写转换
 **/
echo 'A' | ' '; 
echo 'a' & '_';
echo 'a' ^ ' ';
echo 'A' ^ ' ' .PHP_EOL;

// 是否异号
echo (bool)((-1 ^ 2) <0) .PHP_EOL;
echo ((1 ^ 2) <0) .PHP_EOL;

// switch variable
$a = 1;
$b = 3;
$a ^= $b;
$b ^= $a;
$a ^= $b;
echo $a .' ' . $b;

$c = 'Hello';
$d = $c;
$c='World';
echo $d;


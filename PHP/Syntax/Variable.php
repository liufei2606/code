<?php

$foo = 'Bob';
$bar = &$foo;
$bar = "My name is $bar";
echo $bar;
echo $foo;

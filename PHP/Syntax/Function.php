<?php

function foo()
{
    echo "In foo()<br />\n";
}

function bar($arg = '')
{
    echo "In bar(); argument was '$arg'.<br />\n";
}

// 使用 echo 的包装函数
function echoit($string)
{
    echo $string;
}

$func = 'foo';
$func();        // This calls foo()

$func = 'bar';
$func('test');  // This calls bar()

$func = 'echoit';
$func('test');  // This calls echoit()

# 匿名函数

$d = 10;
function myFunction($d) {
    echo $d;
    ++$d;
    echo $d;
}

myFunction($d++); # 传入10,传值， 作用域
echo $d . PHP_EOL; # 11 作用域

$f =7;
function myFunction1(&$d) {
    return $d++;
}
myFunction1($f);

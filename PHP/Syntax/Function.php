<?php

function bar(string $arg = ''): string
{
    return "In bar(); argument was '$arg'\n";
}

$func = 'bar';
echo $func('test');

function add(int $a, int $b): int
{
    $a += $b;
    return $a;
}

# 值传递
$a = 1;
$b = 2;
$c = add($a, $b);
printf("\$a = %d\n", $a);
printf("\$c = %d\n", $c);

function add_v(int &$a, int $b)
{
    $a += $b;
}

# 引用传递
add_v($a, $b);
printf("\$a = %d\n", $a);

# 作用域
$d = 10;
function myFunction($d)
{
    echo $d.PHP_EOL;
    ++$d;
    echo $d.PHP_EOL;
}

myFunction($d++); # 传入10, 函数入改变对外无影响
echo $d.PHP_EOL;

$f = 7;
function myFunction1(&$d)
{
    return $d++;
}

echo myFunction1($f).PHP_EOL;
echo $f.PHP_EOL;

#### 匿名(闭包)函数Closure
$add = function (int $a, int $b) {
    return $a + $b;
};
echo "$a + $b = ".$add($a, $b).PHP_EOL;

# 动态设置函数类型值
function multi(int $a, int $b): int
{
    return $a * $b;
}

$add = 'multi';
echo "$a x $b = ".$add($a, $b).PHP_EOL;

# 支持在函数体中直接引用上下文变量(继承父作用域的变量)
# 通过 use 关键字传递当前上下文中的变量，就可以在闭包函数体中直接使用，而不需要通过参数形式传入
# 其他引用该文件的代码就可以间接引用当前父作用域下的变量，如果是在类方法中定义的匿名函数，则可以直接引用相应类实例的属性
# 函数　默认不能引用全局变量：
$a = 5;
$b = 6;
function multiV()
{
    return $a * $b;
}

//echo multiV().PHP_EOL;

# 　匿名函数的话
$multi = function () use ($a, $b) {
    return $a * $b;
};
echo $multi().PHP_EOL;

# 基于 global 关键字通过全局变量引用函数体外部定义的变量
$n1 = 100;
$n2 = 54;
function sub()
{
    global $n1, $n2;
    return $n1 - $n2;
}

echo sub().PHP_EOL;

# global vs. 匿名函数:作用域不一样
# 全局变量存在于一个全局的范围
# 而闭包的父作用域是定义该闭包的函数，不一定是调用它的函数
function add1($n1, $n2)
{
    return function () use ($n1, $n2) {
        return $n1 + $n2;
    };
}

function add2()
{
    return function () {
        global $n1, $n2, $n3;
        return $n1 + $n2 + $n3;
    };
}

$n1 = 1;
$n2 = 3;
$n3 = 4;
$add = add1($n1, $n2);
$sum = $add();
echo "$n1 + $n2 = $sum".PHP_EOL;

$add = add2();
$sum = $add();
echo "$n1 + $n2 + $n3 = $sum".PHP_EOL;

# 可变数量的参数列表
//call_user_func
<?php

# 算术运算符:加、减、乘、除、求余
$a = 32;
$b = 8;
$a += $b;
printf("%d\n", $a);
$a -= $b;
printf("%d\n", $a);
$a *= $b;
printf("%d\n", $a);
$a /= $b;
printf("%d\n", $a);
$a %= $b;
printf("%d\n", $a);
echo 2 ** 3 .PHP_EOL;

## 自增/自减运算符
## 后置：先赋值后运算
$a = 32;
$b = 8;
$c = $a++;
$d = $b--;
printf("a,b,c,d = %d,%d,%d,%d\n", $a, $b, $c, $d);
## 前置：先运算后复制
$a = 32;
$b = 8;
$c = ++$a;
$d = --$b;
printf("a,b,c,d = %d,%d,%d,%d\n", $a, $b, $c, $d);

## 比较运算符
var_dump(10 <=> 12);
var_dump(13 <=> 12);
var_dump(12 <=> 12);

# == vs ===: 只比较变量值 除了比较变量值，还会比较变量类型
$c = 32;
$d = 32.0;
var_dump($c == $d);
var_dump($c === $d);

## 逻辑运算符
# 转换为 boolean 时，以下值被认为是 FALSE：
#  布尔值 FALSE 本身
# 整型值 0（零）
#  浮点型值 0.0（零）
# 空字符串，以及字符串 "0"
# 不包括任何元素的数组
# 特殊类型 NULL（包括尚未赋值的变量）
# 从空标记生成的 SimpleXML 对象


// 越靠前优先级越高
echo 0 ?: 1 ?: 2 ?: 3; //1
echo 0 ?: 0 ?: 2 ?: 3; //2
echo 0 ?: 0 ?: 0 ?: 3; //3
echo 0 ?: 4; // 4

$a = 36;
$b = 56;
$c = 67;
echo $a ?? $b ?? $c;

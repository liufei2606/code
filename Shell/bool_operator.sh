#!/bin/bash
num1=3
num2=23

if [ $num1 != $num2 ]; then
    echo "$num1 != $num2 : num1 不等于 num2"
else
    echo "$num1 != $num2: num1 等于 num2"
fi

if [ $num1 -lt 25 -a $num2 -gt 15 ]; then
    echo "$num1 小于 25 且 $num2 大于 15 : 返回 true"
else
    echo "$num1 小于 25 且 $num2 大于 15 : 返回 false"
fi

if [ $num1 -lt 25 -o $num2 -gt 25 ]; then
    echo "$num1 小于 25 或 $num2 大于 25 : 返回 true"
else
    echo "$num1 小于 25 或 $num2 大于 25 : 返回 false"
fi

a=10
b=100

if [ $a != $b ]; then
    echo "$a != $b : a 不等于b"
else
    echo "$a != $b : a 等于b"
fi
if [ $a -gt 10 -a $b -lt 100 ]; then
    echo "$a -gt 10 -a $b -lt 100 : True"
else
    echo "$a -gt 10 -a $b -lt 100 : False"
fi

if [ $a -gt 10 -o $b -lt 10 ]; then
    echo "$a -gt 10 -o $b -lt 100 : True"
else
    echo "$a -gt 10 -o $b -lt 100 : False"
fi

if [[ $a -gt 10 && $b -lt 100 ]]; then
    echo "$a -gt 10 && $b -lt 100 : True"
else
    echo "$a -gt 10 && $b -lt 100 : False"
fi

if [[ $a -gt 10 || $b -lt 10 ]]; then
    echo "$a -gt 10 || $b -lt 100 : True"
else
    echo "$a -gt 10 || $b -lt 100 : False"
fi

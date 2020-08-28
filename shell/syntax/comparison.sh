#!/bin/bash
num1=5
num2=8

if [ $num1 -eq $num2 ]; then
    echo "$num1 是否等于 $num2 : num1 等于 num2"
else
    echo "$num1 是否等于 $num2: num1 不等于 num2"
fi
if [ $num1 -ne $num2 ]; then
    echo "$num1 是否不等于 $num2: num1 不等于 num2"
else
    echo "$num1 是否不等于 $num2 : num1 等于 num2"
fi
if [ $num1 -gt $num2 ]; then
    echo "$num1 是否大于 $num2: num1 大于 num2"
else
    echo "$num1 是否大于 $num2: num1 不大于 num2"
fi
if [ $num1 -lt $num2 ]; then
    echo "$num1 是否小于 $num2: num1 小于 num2"
else
    echo "$num1 是否小于 $num2: num1 不小于 num2"
fi
if [ $num1 -ge $num2 ]; then
    echo "$num1 是否大于等于 $num2: num1 大于或等于 num2"
else
    echo "$num1 是否大于等于 $num2: num1 小于 num2"
fi
if [ $num1 -le $num2 ]; then
    echo "$num1 是否小于等于 $num2: num1 小于或等于 num2"
else
    echo "$num1 是否小于等于 $num2: num1 大于 num2"
fi

a=10
b=100

if [ $a == $b ]; then
    echo "$a equal $b"
fi
if [ $a != $b ]; then
    echo "$a not equal $b"
fi

if [ $a -eq $b ]; then
    echo "$a is equal $b "
else
    echo "$a is not equal $b"
fi

if [ $a -ne $b ]; then
    echo "$a is not equal $b "
else
    echo "$a is equal $b"
fi

if [ $a -gt $b ]; then
    echo "$a is greater $b "
else
    echo "$a is not greater$ b"
fi

if [ $a -lt $b ]; then
    echo "$a is lighter $b "
else
    echo "$a is not lighter $b"
fi

if [ $a -ge $b ]; then
    echo "$a is greater or equal $b "
else
    echo "$a is not greater or equal $b"
fi

if [ $a -le $b ]; then
    echo "$a is lighter $b "
else
    echo "$a is not lighter and equal $b"
fi

if test $((a)) -eq $((b)); then
    echo 'equal'
else
    echo 'not equal'
fi

result=$((a + b))
echo "reault is $result"

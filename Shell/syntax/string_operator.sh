#!/bin/bash
apple="apple"
pen="pen"

if [ $apple = $pen ]; then
    echo "$apple = $pen : apple 等于 pen"
else
    echo "$apple = $pen: apple 不等于 pen"
fi

if [ $apple != $pen ]; then
    echo "$apple != $pen : apple 不等于 pen"
else
    echo "$apple != $pen: apple 等于 pen"
fi

if [ -z $apple ]; then
    echo "-z $apple : 字符串长度为 0"
else
    echo "-z $apple : 字符串长度不为 0"
fi

if [ -n "$apple" ]; then
    echo "-n $apple : 字符串长度不为 0"
else
    echo "-n $apple : 字符串长度为 0"
fi

if [ $apple ]; then
    echo "$apple : 字符串不为空"
else
    echo "$apple : 字符串为空"
fi

c='abc'
d='efg'

if [ $c = $b ]; then
    echo "$c = $b : c 等于 d"
else
    echo "$c = $b : c 不等于 d"
fi
if [ -z $c ]; then
    echo "-z $c:字符串长度为0"
else
    echo "-z $c:字符串长度不为0"
fi
if [ -n $c ]; then
    echo "-n $c:字符串长度不为0"
else
    echo "-z $c:字符串长度为0"
fi

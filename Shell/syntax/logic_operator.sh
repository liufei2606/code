#!/bin/bash
num1=5
num2=8

if [[ $num1 -lt 10 && $num2 -gt 5 ]]; then
    echo "返回 true"
else
    echo "返回 false"
fi

if [[ $num1 -lt 10 || $num2 -gt 5 ]]; then
    echo "返回 true"
else
    echo "返回 false"
fi

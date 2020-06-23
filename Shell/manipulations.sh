#! /bin/bash

a=22
b=10

val=$(expr $a + $b)
echo "$a + $b = $val"

val=$(expr $a - $b)
echo "$a - $b = $val"

val=$(expr $a \* $b)
echo "$a * $b = $val"

val=$(expr $a / $b)
echo "$a / $b = $val"
val=$(expr $a % $b)
echo "$a % $b = $val"

i=1
j=2

addition=$(expr $i + $j)
subtraction=$(expr $i - $j)
multiplication=$(expr $j \* $j)
division=$(expr $j / $i)
mod=$(expr $j % $i)
echo "addition=${addition} , subtraction=${subtraction} , multiplication=${multiplication} , division=${division} , mod=${mod}"

if [ $i == $j ]; then
    echo "i 等于 j"
fi

if [ $i != $j ]; then
    echo "i 不等于 j"
fi

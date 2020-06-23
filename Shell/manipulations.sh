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

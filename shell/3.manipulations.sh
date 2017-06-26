#! /bin/bash

a=22
b=10

# matipulation
echo "-- manipulation ---"
val=`expr $a + $b`
echo "a + b : $val"

val=`expr $a - $b`
echo "a - b : $val"

val=`expr $a \* $b`
echo "a * b : $val"

val=`expr $a / $b`
echo "a / b : $val"
val=`expr $a % $b`
echo "a % b : $val"

# use space
if [ $a == $b ]
then
  echo "$a equal $b"
fi
if [ $a != $b ]
then
  echo "$a not equal $b"
fi

# comparison
echo "-- comparison ---"
if [ $a -eq $b ]
then
  echo "$a is equal $b "
else
  echo "$a is not equal $b"
fi

if [ $a -ne $b ]
then
  echo "$a is not equal $b "
else
  echo "$a is equal $b"
fi

if [ $a -gt $b ]
then
  echo "$a is greater $b "
else
  echo "$a is not greater$ b"
fi

if [ $a -lt $b ]
then
  echo "$a is lighter $b "
else
  echo "$a is not lighter $b"
fi

if [ $a -ge $b ]
then
  echo "$a is greater or equal $b "
else
  echo "$a is not greater or equal $b"
fi

if [ $a -le $b ]
then
  echo "$a is lighter $b "
else
  echo "$a is not lighter and equal $b"
fi

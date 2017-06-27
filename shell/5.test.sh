#! /bin/bash
# test test conditon is valid
a=10
b=20
if test $[a] -eq $[b]
then
  echo 'equal'
else
  echo 'not equal'
fi

result=$[a+b]
echo "reault is $result"

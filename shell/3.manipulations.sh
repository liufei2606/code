#! /bin/bash

a=22
b=10

# matipulation
echo "-- manipulation ---"
val=`expr $a + $b`
echo "$a + $b = $val"

val=`expr $a - $b`
echo "$a - $b = $val"

val=`expr $a \* $b`
echo "$a * $b = $val"

val=`expr $a / $b`
echo "$a / $b = $val"
val=`expr $a % $b`
echo "$a % $b = $val"

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

# bool
echo "-- bool ---"
if [ $a != $b ]
then
  echo "$a != $b : a 不等于b"
else
  echo "$a != $b : a 等于b"
fi
if [ $a -gt 10 -a $b -lt 100 ]
then
  echo "$a -gt 10 -a $b -lt 100 : True"
else
  echo "$a -gt 10 -a $b -lt 100 : False"
fi

if [ $a -gt 10 -o $b -lt 10 ]
then
  echo "$a -gt 10 -o $b -lt 100 : True"
else
  echo "$a -gt 10 -o $b -lt 100 : False"
fi

if [[ $a -gt 10 && $b -lt 100 ]]
then
  echo "$a -gt 10 && $b -lt 100 : True"
else
  echo "$a -gt 10 && $b -lt 100 : False"
fi

if [[ $a -gt 10 || $b -lt 10 ]]
then
  echo "$a -gt 10 || $b -lt 100 : True"
else
  echo "$a -gt 10 || $b -lt 100 : False"
fi

echo "-- string ---"
c='abc'
d='efg'
if [ $c = $b ]
then
  echo "$c = $b : c 等于 d"
else
  echo "$c = $b : c 不等于 d"
fi
if [ -z $c ]
then
  echo "-z $c:字符串长度为0"
else
  echo "-z $c:字符串长度不为0"
fi
if [ -n $c ]
then
  echo "-n $c:字符串长度不为0"
else
  echo "-z $c:字符串长度为0"
fi

echo '----- file -----'
file=$0
if [ -r $file ]
then
   echo "文件可读"
else
   echo "文件不可读"
fi
if [ -w $file ]
then
   echo "文件可写"
else
   echo "文件不可写"
fi
if [ -x $file ]
then
   echo "文件可执行"
else
   echo "文件不可执行"
fi
if [ -f $file ]
then
   echo "文件为普通文件"
else
   echo "文件为特殊文件"
fi
if [ -d $file ]
then
   echo "文件是个目录"
else
   echo "文件不是个目录"
fi
if [ -s $file ]
then
   echo "文件不为空"
else
   echo "文件为空"
fi
if [ -e $file ]
then
   echo "文件存在"
else
   echo "文件不存在"
fi

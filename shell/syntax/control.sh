#! /bin/bash

echo '----- if ------'
if [ $(ps -ef | grep -c "ssh") -gt 1 ]; then echo "true"; fi

a=10
b=20

if [ $a == $b ]; then
  echo 'a equal b'
elif [[ $a -gt $b ]]; then
  echo 'a greater b'
else
  echo 'a lighter b'
fi

echo '----- for-loop ------'
for loop in 1 2 3 4 5; do
  echo "The value is： $loop"
done

echo '------ while loop ------'
int=1
while [[ $int < =5 ]]; do
  echo $int
  # Bash let 命令，它用于执行一个或多个表达式，变量计算中不需要加上 $ 来表示变量
  let "int++"
done

echo '------ case control ------'
echo 'Input a number 0~4: '
echo 'Your number is:'
read aNum
case $aNum in
1)
  echo 'choice 1'
  ;;
2)
  echo 'choice 2'
  ;;
3)
  echo 'choice 3'
  ;;
4)
  echo 'choice 4'
  ;;
a)
  echo 'choice a'
  ;;
esac

echo '------ break and continue ------'
while :; do
  echo -n 'Input number 1~5:'
  read aNum
  case $aNum in
  1 | 2 | 3 | 4 | 5)
    echo "Choice $aNum"
    ;;
  *)
    echo 'Out of range!Game over'
    break
    ;;
  esac
done
# no limit
while true; do
  echo -n 'Input number 1~5:'
  read aNum
  case $aNum in
  1 | 2 | 3 | 4 | 5)
    echo "Choice $aNum"
    ;;
  *)
    echo 'Out of range'
    continue
    echo 'Game over'
    ;;
  esac
done

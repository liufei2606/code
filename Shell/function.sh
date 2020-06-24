#! /bin/bash

function funWithReturn() {
  echo "Function is to add two number."
  echo "Input the first number:"
  read aNum
  echo "Input the second number:"
  read anotherNum

  return $(($aNum + $anotherNum))
}

funWithReturn
echo "The result is $? !"

funWithParam() {
  echo "第一个参数为 $1 !"
  echo "第二个参数为 $2 !"
  echo "第十个参数为 $10 !"
  echo "第十个参数为 ${10} !"
  echo "第十一个参数为 ${11} !"
  echo "参数总数有 $# 个!"
  echo "作为一个字符串输出所有参数 $* !"
}
funWithParam 1 2 3 4 5 6 7 8 9 34 73

# 输出重定向
who >log
echo "Hello World!" >>output

# count file use
wc -l function.sh

# 每个 Unix/Linux 命令运行时都会打开三个文件：
#    标准输入文件(stdin)：stdin的文件描述符为0，Unix程序默认从stdin读取数据。
#    标准输出文件(stdout)：stdout 的文件描述符为1，Unix程序默认向stdout输出数据。
#    标准错误文件(stderr)：stderr的文件描述符为2，Unix程序会向stderr流中写入错误信息。

# command > file 将 stdout 重定向到 file，command < file 将stdin 重定向到 file。

#  将 stdout 和 stderr 合并后重定向到 file
pwd >>log 2>&1

pwd <log >output

# 执行某个命令，但又不希望在屏幕上显示输出结果，那么可以将输出重定向到 /dev/null

git >/dev/null

# 屏蔽 stdout 和 stderr
git >/dev/null 2>&1

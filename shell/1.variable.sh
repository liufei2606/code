#!/bin/bash

#--------------------------------------------
# 这是一个注释
# author：菜鸟教程
# site：www.runoob.com
# slogan：学的不仅是技术，更是梦想！
#--------------------------------------------
##### 用户配置区 开始 #####
#
#
# 这里可以添加脚本描述信息
#
#
##### 用户配置区 结束  #####


# string
echo "Hello World!"

# variable
your_name='Henry'
echo "Variable: "$your_name
echo "Variable: "${your_name}

# for-loop
for skill in Ada Coffe Action Java; do
    echo "I am good at ${skill} Script"
done

# list folder's file
for file in `ls /home/henry`; do
  echo $file;
done;

# readonly can't modify and delete,
only_read="Arsenal"
readonly only_read

# unset variable can't use again
only_read_new="Wenger"
echo ${only_read_new}
unset only_read_new

# variable scope

# output string
# "":can have variable character
greeting="Hello, $your_name!"
echo $greeting
greeting="Hello, \"$your_name\"! "
greeting_1="Hello, ${your_name}!"
echo $greeting $greeting_1

# string function
string="efghtcdtabcd"
# length
echo ${#string}
# strim
echo ${string:2:3}
# get index
echo `expr index "$string" cd`

# array
arr=(1 2 3 4 a d)
echo ${arr[@]}
echo ${#arr[*]} ${#arr[n]} ${#arr[@]}
echo ${arr[4]}

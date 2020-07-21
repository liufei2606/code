#!/bin/bash

#--------------------------------------------
# 注释
# author：henry
#--------------------------------------------

##### 用户配置区 开始 #####
#
#
# 脚本描述信息
#
#
##### 用户配置区 结束  #####

# string
echo "Print string:Hello World!"

# variable
your_name='Henry'
echo "Print Variable: "$your_name . ${your_name}

# for-loop
for skill in Ada Coffe Action Java; do
  echo "I am good at ${skill} Script"
done

# list folder's files
directory=$(
  cd $(dirname $0)
  pwd -P
)
echo "List current directory:"
for file in $(ls $directory); do
  echo $file
done

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
echo $(expr index "$string" cd)

# array
arr=(1 2 3 4 a d)
echo ${arr[4]}
echo “数组的元素为：${arr[*]}”
echo “数组的元素为：${arr[@]}”
echo “数组的个数为：${#arr[*]}”
echo “数组的个数为：${#arr[@]}”

: <<EOF
  是法师打发是


  sfaasdfa
EOF

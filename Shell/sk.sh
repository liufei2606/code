#!/bin/bash
#打印出所有参数

set -o nounset
set -o errexit

echo $*

# 函数
ExtractBashComments() {
   egrep "^#"
}

fileName=$0
cat ${fileName} | ExtractBashComments | wc

comments=$(ExtractBashComments < $fileName)

SumLines() {
# iterating over stdin - similar to awk
   local sum=0
   local line=””
   while read line ; do
       sum=$((${sum} + ${line}))
   done
   echo ${sum}
}
# SumLines < data_one_number_per_line.txt

log() {
# classic logger
  local prefix="[$(date +%Y/%m/%d\ %H:%M:%S)]: "
  echo "${prefix} $@" >&2
}

log "INFO" "a message"

# both commands below print out: A-B-C-D
echo "A-`echo B-\`echo C-\\\`echo D\\\`\``"
echo "A-$(echo B-$(echo C-$(echo D)))"

# [[ "${name}" > "a" && "${name}" < "m"  ]]

t="abc123"
[[ "$t" == abc* ]] # true (globbing比较)
[[ "$t" == "abc*" ]] # false (字面比较)
[[ "$t" =~ [abc]+[123]+ ]] # true (正则表达式比较)
[[ "$t" =~ "abc*" ]] # false (字面比较)

f="path1/path2/file.ext"
len="${#f}" # = 20 (字符串长度)
# 切片操作: ${<var>:<start>} or ${<var>:<start>:<length>}
slice1="${f:6}" # = "path2/file.ext"
slice2="${f:6:5}" # = "path2"
slice3="${f: -8}" # = "file.ext"(注意："-"前有空格)
pos=6
len=5
slice4="${f:${pos}:${len}}" # = "path2"

# 替换操作(使用globbing)
single_subst="${f/path?/x}" # = "x/path2/file.ext"
global_subst="${f//path?/x}" # = "x/x/file.ext"

# 字符串拆分
readonly DIR_SEP="/"
array=(${f//${DIR_SEP}/ })
second_dir="${arrray[1]}" # = path2

# 删除字符串头部
extension="${f#*.}"  # = "ext"
# 以贪婪匹配方式删除字符串头部
filename="${f##*/}"  # = "file.ext"
# 删除字符串尾部
dirname="${f%/*}" # = "path1/path2"
# 以贪婪匹配方式删除字符串尾部
root="${f%%/*}" # = "path1"

# 下载并比较两个网页
diff <(wget -O - url1) <(wget -O - url2)

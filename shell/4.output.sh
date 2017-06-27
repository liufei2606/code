#！ /bin/bash

echo "It is great."
echo It is great.
echo "\"It is great.\""

# read stand input
read name
echo "$name It is Ok."

echo  "OK! \n"
echo "It is a test"

echo  "OK! \c"
echo "It is a new test"

echo "It is test" > 'output'

echo 'date'
echo '$name'

# -：align left default right  s:string  4.2f: 两位小数
printf "%-10s %-8s %-4s\n" 姓名 性别 体重kg
printf "%-10s %-8s %-4.2f\n" 郭靖 男 66.1234
printf "%-10s %-8s %-4.2f\n" 杨过 男 68.5678
printf "%d %s\n" 1 'abc'
printf %s abc def
printf "%s and %d \f"

# \n 换行 \r 回车

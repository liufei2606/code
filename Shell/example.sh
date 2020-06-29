#! /bin/bash

#请将当前目录中demo.txt第二行第三列数据输出到demo2.txt中

cat demo.txt | awk ’NR==2{print $3}’ >demo2.txt

# 日志如下统计访问ip最多的前10个

awk ’{print $1}’ *.log | sort | uniq -c | sort -nr | head -n

# 查看占用内存最大的进程的PID和VSZ

ps -aux | sort -k5nr | awk ’BEGIN{print ”PID VSZ”}{print 2,5}’ | awk ’NR <3′

# 如何检查文件系统中是否存在某个文件

if [-f /var/log/messages]; then
    echo "File exts"
fi

# 脚本文件中，如何将其重定向标准输出和标准错误流到 log.txt 文件 ?

./a.sh >log.txt 2>&1
# 如何计算本地用户的数目

wc -l /etc/passwd | cut -d
shell中进行字符串比较和数字比较

[ $A == $B ]  #用于字符串比较
[ $A -eq $B ] # 用于数字比较

#去掉字符串空格
echo $string | tr -d " "

#　统计内存使用
sum=0
for mem in $(ps aux | awk '{print $6}' | grep -v 'RSS'); do
    sum=$(($sum + $mem))
done
echo "The total memory is $sum""k"

# 批量修改123目录下txt为txt.temp。将temp打包为test.tar.gz
#查找txt文件
find /123 -type f -name "*.txt" >/tmp/txt.list
#批量修改文件名
for f in $(cat /tmp/txt.list); do
    mv $f $f.temp
done
#创建一个目录，为了避免目录已经存在，所以要加一个复杂的后缀名
d=$(date +%y%m%d%H%M%S)
mkdir /tmp/123_$d
##把.temp文件拷贝到/tmp/123_$d
for f in $(cat /tmp/txt.list); do
    cp $f.temp /tmp/123_$d
done
#打包压缩
cd /tmp/
tar czf 123.tar.gz 123_$d/

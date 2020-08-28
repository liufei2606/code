# 写一个脚本，实现批量添加20个用户，用户名为user01-20，密码为user后面跟5个随机字符
#!/bin/bash
#description: useradd

for i in $(seq -f”%02g” 1 20); do
    useradd user$i
    echo “user$i-$(echo $RANDOM | md5sum | cut -c 1-5)” | passwd –stdinuser$i >/dev/null 2>&1
done

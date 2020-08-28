# 写一个脚本，判断一个指定的脚本是否是语法错误；如果有错误，则提醒用户键入Q或者q无视错误并退出其它任何键可以通过vim打开这个指定的脚本
#!/bin/bash
read -p “please input check script-> ” file
if [ -f $file ]; then
sh -n $file > /dev/null 2>&1
if [ $? -ne 0 ]; then
read -p “You input $file syntax error,[Type q to exit or Type vim to edit]” answer
case $answer in
q | Q)
exit 0
;;
vim )
vim $file
;;
*）
exit 0
;;
esac
fi
else
echo “$file not exist”
exit 1
fi
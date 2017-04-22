#!/bin/bash
echo "Hello World!"
your_name='Henry'
echo $your_name
echo ${your_name}
# for skill in Ada Coffe Action Java; do
#     echo "I am good at ${skill} Script"
# done
only_read="Arsenal"
# readonly only_read
# unset only_read
# only_read="Wenger"
echo ${only_read}
greeting="hello, "$your_name" !"
echo $greeting
greeting_1="hello, ${your_name}!"
echo $greeting_1
string="abcd"
echo ${#string}
echo ${string:2:3}
echo `expr index "$string" cd`
array=(1 2 3 4 a d)
echo ${array[@]} ${#array[@]}
echo ${array[4]}
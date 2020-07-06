A = 360     --定义全局变量
local square = require "square"

local s1 = square:new(1, 2)
print(s1:get_square())
print(s1:get_circumference())

local b = s1.add(A, A)
print("b = ", b)

s1.update_A()
print("A = ", A)
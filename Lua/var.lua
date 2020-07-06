g_var = 1         -- global var
local l_var = 2   -- local var

x = 10
local i = 1         -- 程序块中的局部变量 i

while i <=x do
  local x = i * 2   -- while 循环体中的局部变量 x
  print(x)          -- output： 2, 4, 6, 8, ...
  i = i + 1
end

if i > 20 then
  local x           -- then 中的局部变量 x
  x = 20
  print(x + 2)      -- 如果i > 20 将会打印 22，此处的 x 是局部变量
else
  print(x)          -- 打印 10，这里 x 是全局变量
end

print(x)            -- 打印 10

-- 虚变量
local _,finish = string.find("hello", "he")   --采用虚变量（即下划线），接收起始下标值，然后丢弃，finish接收 结束下标值
print ( finish )                              --输出 2
print ( _ )                                   --输出 1, `_` 只是一个普通变量,我们习惯上不会读取它的值

local t = {1, 3, 5}
print("")
print("part data:")
for _,v in ipairs(t) do
    print(v)
end
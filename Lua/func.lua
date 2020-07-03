local function max(a, b)  --定义函数 max，用来求两个数的最大值，并返回
    local temp = nil       --使用局部变量 temp，保存最大值
    if(a > b) then
       temp = a
    else
       temp = b
    end
    return temp            --返回最大值
 end

local m = max(-12, 20)    --调用函数 max，找去 -12 和 20 中的最大值
 print(m)

 local function swap(a, b) --定义函数swap,函数内部进行交换两个变量的值
    local temp = a
    a = b
    b = temp
    print(a, b)
 end

 local x = "hello"
 local y = 20
 print(x, y)
 swap(x, y)    --调用swap函数
 print(x, y)   --调用swap函数后，x和y的值并没有交换


 local function func( ... )                -- 形参为 ... ,表示函数采用变长参数
    local temp = {...}                     -- 访问的时候也要使用 ...
    local ans = table.concat(temp, " ")    -- 使用 table.concat 库函数对数
                                           -- 组内容使用 " " 拼接成字符串。
    print(ans)
 end

func(1, 2)        -- 传递了两个参数
func(1, 2, 3, 4)  -- 传递了四个参数

---> 引用传递
local function change(arg) -- change 函数，改变长方形的长和宽，使其各增长一倍
    arg.width = arg.width * 2  --表arg不是表rectangle的拷贝，他们是同一个表
    arg.height = arg.height * 2
end
local rectangle = { width = 20, height = 15 }
print("before change:", "width  =", rectangle.width,
                        "height =", rectangle.height)
change(rectangle)
print("after  change:", "width  =", rectangle.width,
                        "height =", rectangle.height)

local s, e = string.find("hello world", "llo")
print(s, e)

local function init()       -- init 函数 返回两个值 1 和 "lua"
    return 1, "lua"
end

local x, y, z = init(), 2   -- init 函数的位置不在最后，此时只返回 1
print(x, y, z)              -->output  1  2  nil

local a, b, c = 2, init()   -- init 函数的位置在最后，此时返回 1 和 "lua"
print(a, b, c)              -->output  2  1  lua 英雄的黎明


local function run(x, y)
    print('run', x, y)
end

local function attack(targetId)
    print('targetId', targetId)
end

local function do_action(method, ...)
    local args = {...} or {}
    method(unpack(args, 1, table.maxn(args)))
end

do_action(run, 1, 2)         -- output: run 1 2
do_action(attack, 1111)      -- output: targetId    1111
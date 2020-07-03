score = 90
if score == 100 then
    print("Very good!Your score is 100")
elseif score >= 60 then
    print("Congratulations, you have passed it,your score greater or equal to 60")
--此处可以添加多个elseif
else
    print("Sorry, you do not pass the exam! ")
end

score = 0
if score == 100 then
    print("Very good!Your score is 100")
elseif score >= 60 then
    print("Congratulations, you have passed it,your score greater or equal to 60")
else
    if score > 0 then
        print("Your score is better than 0")
    else
        print("My God, your score turned out to be 0")
    end --与上一示例代码不同的是，此处要添加一个end
end

x = 1
sum = 0

while x <= 5 do
    sum = sum + x
    x = x + 1
end
print(sum)

local t = {1, 3, 5, 8, 11, 18, 21}
local i
for i, v in ipairs(t) do
    if 11 == v then
        print("index[" .. i .. "] have right value[11]")
        break
    end
end

x = 10
repeat
    print(x)
until false

for i = 1, 10, 2 do
    print(i)
end

for i = 1, math.huge do
    if (0.3*i^3 - 20*i^2 - 500 >=0) then
      print(i)
      break
    end
end

local a = {"a", "b", "c", "d"}
for i, v in ipairs(a) do
  print("index:", i, " value:", v)
end

for k in pairs(t) do
    print(k)
end

local days = {
    "Monday", "Tuesday", "Wednesday", "Thursday",
    "Friday", "Saturday","Sunday"
 }

 local revDays = {}
 for k, v in pairs(days) do
   revDays[v] = k
 end

 -- print value
 for k,v in pairs(revDays) do
   print("k:", k, " v:", v)
 end

sum = 0
i = 1
while true do
    sum = sum + i
    if sum > 100 then
        break
    end
    i = i + 1
end
print("The result is " .. i)

for i=1, 3 do
    if i <= 2 then
        print(i, "yes continue")
        goto continue
    end

    print(i, " no continue")

    ::continue::
    print([[i'm end]])
end


local function process(input)
    print("the input is", input)
    if input < 2 then
        goto failed
    end
    -- 更多处理流程和 goto err

    print("processing...")
    do return end
    
    ::failed::
    print("handle error with input", input)
end

process(1)
process(3)

file = io.open("test1.txt", "a+")   -- 使用 io.open() 函数，以添加模式打开文件
io.output(file)                     -- 使用 io.output() 函数，设置默认输出文件
io.write("\nhello world")           -- 使用 io.write() 函数，把内容写到文件
io.close(file)

file = io.input("test1.txt")    -- 使用 io.input() 函数打开文件

repeat
    line = io.read()            -- 逐行读取内容，文件结束时返回nil
    if nil == line then
        break
    end
    print(line)
until (false)
io.close(file)                  -- 关闭文件


file = io.open("test2.txt", "a")  -- 使用 io.open() 函数，以添加模式打开文件
file:write("\nhello world")       -- 使用 file:write() 函数，在文件末尾追加内容
file:close()

file = io.open("test2.txt", "r")    -- 使用 io.open() 函数，以只读模式打开文件
for line in file:lines() do         -- 使用 file:lines() 函数逐行读取文件
   print(line)
end

file:close()
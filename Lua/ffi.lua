local ffi = require "ffi"

local myffi = ffi.load('myffi')
ffi.load('myffi',true)

ffi.cdef[[
int add(int x, int y);   /* don't forget to declare */
]]

local res = myffi.add(1, 2)
print(res)

-- 用 ffi.C (调用 ffi.cdef 中声明的系统函数) 来直接调用 add 函数，记得要在 ffi.load 的时候加上参数 true
local res1 = ffi.C.add(1, 2)
print(res1)

local uintptr_t = ffi.typeof("uintptr_t")
local c_str_t = ffi.typeof("const char*")
local int_t = ffi.typeof("int")
local int_array_t = ffi.typeof("int[?]")

local int_array_t = ffi.typeof("int[?]")
-- local bucket_v = ffi.new(int_array_t, bucket_sz)

-- local queue_arr_type = ffi.typeof("lrucache_pureffi_queue_t[?]")
-- local q = ffi.new(queue_arr_type, size + 1)

-- ffi.fill(self.bucket_v, ffi_sizeof(int_t, bucket_sz), 0)
-- ffi.fill(q, ffi_sizeof(queue_type, size + 1), 0)

-- local c_str_t = ffi.typeof("const char*")
-- local c_str = ffi.cast(c_str_t, str)       -- 转换为指针地址

-- local uintptr_t = ffi.typeof("uintptr_t")
-- tonumber(ffi.cast(uintptr_t, c_str))       -- 转换为数字


ffi.cdef[[
unsigned long compressBound(unsigned long sourceLen);
int compress2(uint8_t *dest, unsigned long *destLen,
        const uint8_t *source, unsigned long sourceLen, int level);
int uncompress(uint8_t *dest, unsigned long *destLen,
         const uint8_t *source, unsigned long sourceLen);
]]
local zlib = ffi.load(ffi.os == "Windows" and "zlib1" or "z")

local function compress(txt)
  local n = zlib.compressBound(#txt)
  local buf = ffi.new("uint8_t[?]", n)
  local buflen = ffi.new("unsigned long[1]", n)
  local res = zlib.compress2(buf, buflen, txt, #txt, 9)
  assert(res == 0)
  return ffi.string(buf, buflen[0])
end

local function uncompress(comp, n)
  local buf = ffi.new("uint8_t[?]", n)
  local buflen = ffi.new("unsigned long[1]", n)
  local res = zlib.uncompress(buf, buflen, comp, #comp)
  assert(res == 0)
  return ffi.string(buf, buflen[0])
end

-- Simple test code.
local txt = string.rep("abcd", 1000)
print("Uncompressed size: ", #txt)
local c = compress(txt)
print("Compressed size: ", #c)
local txt2 = uncompress(c, #txt)
assert(txt2 == txt)


ffi.cdef[[
typedef struct { double x, y; } point_t;
]]

local point
local mt = {
  __add = function(a, b) return point(a.x+b.x, a.y+b.y) end,
  __len = function(a) return math.sqrt(a.x*a.x + a.y*a.y) end,
  __index = {
    area = function(a) return a.x*a.x + a.y*a.y end,
  },
}
point = ffi.metatype("point_t", mt)

local a = point(3, 4)
print(a.x, a.y)  --> 3  4
print(#a)        --> 5
print(a:area())  --> 25
local b = a + point(0.5, 8)
print(#b) 
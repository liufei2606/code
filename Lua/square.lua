local _M = { _VERSION = '0.01' }
_M._VERSION = '1.0'     -- 模块版本

local mt = { __index = _M }

function _M.new(self, width, height)
    return setmetatable({ width=width, height=height }, mt)
end

function _M.get_square(self)
    return self.width * self.height
end

function _M.get_circumference(self)
    return (self.width + self.height) * 2
end

function _M.add(a, b)     --两个number型变量相加
    return a + b
end

-- ，如果之前没有定义过，那么认为它是一个全局变量
function _M.update_A()    --更新变量值
    A = 365
end

return _M
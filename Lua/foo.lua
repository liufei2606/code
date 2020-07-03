local _M = { _VERSION = '0.01' }

function _M.add(a, b)     --两个number型变量相加
    return a + b
end

-- ，如果之前没有定义过，那么认为它是一个全局变量
function _M.update_A()    --更新变量值
    A = 365
end

return _M
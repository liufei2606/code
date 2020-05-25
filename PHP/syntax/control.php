<?php
// 减少对if...else...的使用,提前return异常
//　如果是在一个函数里面会先处理异常的情况，然后提前return代码，最后再执行正常的逻辑
function doSomething()
{
    $x = 6;

    if (x > 8) {
        return ;
    }
    if (x>19) {
        return ;
    }

    return true;
}

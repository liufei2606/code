<?php
// 减少对if...else...的使用,提前return异常
//　如果是在一个函数里面我会先处理异常的情况，然后提前return代码，最后再执行正常的逻辑
function doSomething() {
    if (...) {
        // 异常情况
        return ...;
    }
    if (...) {
        // 异常情况
        return ...;
    }
    //　正常逻辑
    ...
}

//　同样，如果是在一个类里面我会先处理异常的情况，然后先抛出异常
class One
{
    public function doSomething()
    {
        if (...) {
            // 异常情况
            throw new Exception(...);
        }
        if (...) {
            // 异常情况
            throw new Exception(...);
        }
        //　正常逻辑
        ...
    }
}

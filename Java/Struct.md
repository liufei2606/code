# 知识点

* 基础
    - 环境搭建
    - 基本类型
    - 引用类型(reference)
        - 数组:相同类型变量集合(定长)
            - 索引数组：变量名是第一个内存地址（指向），实际是一块地址连续内存
            - 0 开始方便使用索引
            - 多维数组是索引多维,第一维指向数组的起始地址 
            - 引用数组
        + 寻址：初始地址　+ 偏移
        + string
        + 引用与对象，数据类型一致
    - 编码
    - 运算符
    - 控制语句
    - 变量作用域
        + 作用域：局限于当前代码块内部使用

* 面向对象
    * class object
    - 属性　private
    * 实例：堆
    * 类属性引用
        + 自定义类
        + 当前类
    * package
        + 全限定名唯一
    - 封装
        + 类内部方法操作内部数据
        + 缺省修饰符　protected：只能被当前包内类以及子类引用
        + private 构造 + static　构造（实例化前检查）
        + public 方法是一种约定，不能随意改动,对外公布,private 内部实现共享
        + 非public　class 可以名字不一样，调用范围有限
    - 继承
        + 覆盖：方法　签名　返回值一样
        + super:必须第一行
        + 子类会默认调用弗父类无参构造方法，父类没有无参构造，子类必须生命构造调用父类有参构造
        - 组合:注入
    - 多态
        + 重载（overload）：方法名+参数 唯一，调用别的重载方法，多态在于参数。参数可以转换就行
            * 调动最近的转换类型：byte->short->int->long->float->double
            * 构造方法重载 this(),第一行
            * 静态多态：跟引用类型有关，与实际对象无关，没有回溯，往链上方
        + 重写　override　动态多态
            + 父类应用可以指向子类对象,引用对象类型决定调用的方法，可以转换为父类类型
        + 75
    - 方法不改变实参（引用）
    - 返回参数不受外边影响
    - 隐藏　this 自引用
    - 方法是类的一部分，不是对象
    - 静态变量：大写 下划线
        + 可以修改
    - 静态方法：不能直接 this 自引用
        + 重载
    — 静态代码块
        + 使用到静态变量，必须在前面声明
    - instanceof
    - final
        + 属性必须被赋值且一次
        + 引用
    - Object
        + String
        + Class
    - 反射
        - invoke
    - 枚举
    - 接口
        + 允许静态方法　私有方法　带缺省实现的抽象方法
        + 接口继承　
    - 抽象类
    - 静态内部类
* 异常
    - Throwable
    - Error
    - Exception
* 工具类
    - Collection
    - List

## 源码

* Math:工具类，禁止实例化，封装成静态方法
* Scanner
* BigInterger
* String:char array->byte array
    - immutable
    - 数据 private
    - charAt
    - substring
    - toCharArray
    - split
    - indexOf
    - contains
    - equals equalsIngoreCase
    - trim()
* StringBuilder
    - toString()
    - reverse()
    - append()
    - delete()
    - insert()
* main
* System
    - currentTimeMillis()

## 规范

* 变量命名
* 逻辑清楚
* 反复练习：经典例题
* 先主逻辑
* 边界
    - 输入范围与现实限制(库存不够)
    - 领域
        + 类属性　只能自己方法操作
        + 内聚
* 功能整理 实现

## 工具

* debug
    - step over
    - condition stop
    - step into/out:压栈
* javadoc

## 练习

* 超市　商品　车位　购买　顾客 41节 45 第二件半价


## 算法

* 态度
    * 坚持、刻意练习
    * 练习缺陷、弱点地方
    * 不舒服，枯燥
* 方法
    * 反馈
## 代码规范

* PEP 8 规范
* 选择四个空格的缩进，不要使用 Tab
* 每行最大长度请限制在 79 个字符
* 空行规范:全局的类和函数的上方需要空两个空行，而类的函数之间需要空一个空行
* 函数的参数列表中会出现逗号，请注意逗号后要跟一个空格
* 冒号经常被用来初始化字典，冒号后面也要跟一个空格
* `#`后、注释前加一个空格
* 操作符两边都保留空格
* 过长
    - 号来将过长的运算进行封装，此时虽然跨行，但是仍处于一个逻辑引用之下。第二行参数和第一行第一个参数对齐
    - 通过换行符来实现
    
## 文档规范

* 所有 import 尽量放在开头
* 不要使用 import 一次导入多个模块

## 注释规范

* 英文注释:请注意开头大写及结尾标点，注意避免语法错误和逻辑错误，同时精简要表达的意思
* 文档描述

## 命名规范

* 变量使用小写，通过下划线串联起来
* 常量，最好的做法是全部大写，并通过下划线连接
* 函数名，同样也请使用小写的方式，通过下划线连接起来
* 类名，则应该首字母大写，然后合并起来

## 代码分解

* 不写重复代码
* 减少迭代层数，尽可能让代码扁平化
* 函数的粒度应该尽可能细，不要让一个函数做太多的事情。所以，对待一个复杂的函数，需要尽可能地把它拆分成几个功能简单的函数，然后合并起来
* 类拆分

## 优化

* 从一开始写代码时，就必须对功能和规范这两者双管齐下.功能完整和规范完整的优先级是不分先后的，应该是同时进行的


## 项目文档

* 统的概述，包括各个组成部分以及工作流程的介绍；
* 每个组成部分的具体介绍，包括必要性、设计原理等等
* 系统的 performance，包括 latency 等等参数
* 主要说明如何对系统的各个部分进行修改，主要给出相应的 code pointer 及对应的测试方案
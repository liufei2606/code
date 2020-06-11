# VUE

* v-modal
* v-on:click  @click
    - 触发重新渲染时，调用方法将总会再次执行函数
* v-bind:class :class
* v-if
* $emit
* v-show

## vue 参数

* computed
    - 基于依赖进行缓存
* data:
* method:

## 语法

* 数据绑定
    - 最常见形式就是使用 “Mustache” 语法 (双大括号) 文本插值,绑定的数据对象上 message 属性发生了改变，插值处的内容都会更新
    - 提供了完全 JavaScript 表达式支持

## 组件

* slot
* props
    - 父子 prop 之间形成了一个 单向下行绑定：父级 prop 的更新会向下流动到子组件中，但是反过来则不行。这样会防止从子组件意外改变父级组件的状态，从而导致你的应用的数据流向难以理解
* $children
* data()
* data()
* created()
* 组件间套用
# VUE

## 生命周期

- new Vue()
- init Events & Lifecycle
  - beforeCreate
- init injections & reactivity
  - created 钩子可以用来在一个实例被创建之后执行代码
- has 'el' option?
- has 'template' options
  - Compile template into render function
  - Compile el's outerHTML as template
  - beforeMount
- create vm.\$el and replace 'el' with it
  - mounted
  - beforeUpdate
  - Virtual DOM re-render and patch
  - updated
- when vm.\$destory() called
  - beforeDestory()
- teardown watchers, child compontents and event listensers
- Destroyed
  - destoryed

## 语法

- 声明式渲染:用简洁的模板语法来声明式地将数据渲染进 DOM 的系统
  - 数据和 DOM 已经被建立了关联，所有东西都是响应式的
- 数据绑定
  - 最常见形式就是使用 “Mustache” 语法 (双大括号) 文本插值,绑定的数据对象上 message 属性发生了改变，插值处的内容都会更新
  - 提供了完全 JavaScript 表达式支持，每个绑定都只能包含单个表达式
- 指令 (Directives) 是带有 v- 前缀的特殊 attribute,职责是，当表达式的值改变时，将其产生的连带影响，响应式地作用于 DOM

  - 值预期是单个 JavaScript 表达式 (v-for 是例外情况)
  - 能够接收一个“参数”，在指令名称之后以冒号表示
  - 动态参数:从 2.6.0 开始，可以用方括号括起来的 JavaScript 表达式作为一个指令的参数

    - 预期会求出一个字符串，异常情况下值为 null。这个特殊的 null 值可以被显性地用于移除绑定
    - 表达式有一些语法约束，因为某些字符，如空格和引号，放在 HTML attribute 名里是无效

  - 修饰符 (modifier) 是以半角句号 . 指明的特殊后缀，用于指出一个指令应该以特殊方式绑定 `<form v-on:submit.prevent="onSubmit">...</form>`
  - v-bind|::绑定属性
  - v-modal：实现表单输入和应用状态之间的双向绑定
  - v-on|@:监听 DOM 事件,触发重新渲染时，调用方法将总会再次执行函数
  - v-if:条件性地渲染
  - \$emit
  - v-show：元素始终会被渲染并保留在 DOM 中。v-show 只是简单地切换元素的 CSS property display
  - v-once:也能执行一次性地插值，当数据改变时，插值处的内容不会更新
  - v-html:输出真正的 HTML
  - v-for:基于一个数组来渲染一个列表 `v-for="(item, index) in items"`
    - 可以用 of 替代 in 作为分隔符
    - 可以遍历一个对象的 property `v-for="(value, name, index) in object"`
    - 优先级比 v-if 更高

## vue 参数

- computed 计算属性,基于响应式依赖进行缓存,只在相关响应式依赖发生改变时它们才会重新求值
  - 默认只有 getter
- data
  - 只有当实例被创建时就已经存在于 data 中的 property 才是响应式的
  - 使用 Object.freeze()，这会阻止修改现有的 property，也意味着响应系统无法再追踪变化
- method:
- mounted
- watch 侦听属性:通用方式来观察和响应 Vue 实例上的数据变动

## 组件

- slot
- props
  - 父子 prop 之间形成了一个 单向下行绑定：父级 prop 的更新会向下流动到子组件中，但是反过来则不行。这样会防止从子组件意外改变父级组件的状态，从而导致你的应用的数据流向难以理解
- \$children
- data()
- data()
- created()
- 组件间套用

## 数据

- array
  - push()
  - pop()
  - shift()
  - unshift()
  - sort()
  - filter() 返回一个新数组
  - contact() 返回一个新数组
  - splice() 返回一个新数组
  - reverse()

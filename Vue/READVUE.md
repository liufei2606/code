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
    - 会根据控件类型自动选取正确的方法来更新元素
    - 忽略所有表单元素的 value、checked、selected attribute 的初始值而总是将 Vue 实例的数据作为数据来源
    - 内部为不同输入元素使用不同 property 并抛出不同的事件：
      - text 和 textarea 元素使用 value property 和 input 事件；
      - checkbox 和 radio 使用 checked property 和 change 事件；
      - select 字段将 value 作为 prop 并将 change 作为事件
  - v-on|@:监听 DOM 事件,触发重新渲染时，调用方法将总会再次执行函数
  - v-if:条件性地渲染
  - v-show：元素始终会被渲染并保留在 DOM 中。v-show 只是简单地切换元素的 CSS property display
  - v-once:也能执行一次性地插值，当数据改变时，插值处的内容不会更新
  - v-html:输出真正的 HTML
  - v-for:基于一个数组来渲染一个列表 `v-for="(item, index) in items"`
    - 可以用 of 替代 in 作为分隔符
    - 可以遍历一个对象的 property `v-for="(value, name, index) in object"`
    - 优先级比 v-if 更高

- 事件处理

  - .preventDefault()
  - .stopPropagation()
  - .stop
  - .prevent
  - .capture
  - .self
  - .once
  - .passive
  - .enter
  - .tab
  - .delete (捕获“删除”和“退格”键)
  - .esc
  - .space
  - .up
  - .down
  - .left:鼠标按钮修饰符
  - .right:鼠标按钮修饰符
  - .ctrl
  - .alt
  - .shift
  - .meta: Windows 徽标键 (⊞)|command 键 (⌘)
  - .exact 修饰符允许你控制由精确的系统修饰符组合触发的事件
  - .middle:鼠标按钮修饰符

  - 用修饰符时，顺序很重要；相应的代码会以同样的顺序产生。因此，用 v-on:click.prevent.self 会阻止所有的点击
  - 不要把 .passive 和 .prevent 一起使用，因为 .prevent 将会被忽略，同时浏览器可能会向你展示一个警告。请记住，.passive 会告诉浏览器你不想阻止事件的默认行为

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

- 复用:每个组件都会各自独立维护它的数据
- 嵌套
- 注册：能在模板中使用，组件必须先注册以便 Vue 能够识别
  - 全局注册:可以用在其被注册之后的任何 (通过 new Vue) 新创建的 Vue 根实例，也包括其组件树中的所有子组件的模板中
  - 局部注册
- 子组件可以通过调用内建的 \$emit 方法并传入事件名称来触发一个事件
- 父级组件监听事件时，可以通过 \$event 访问到被抛出的这个值
- v-modal
- 通过插槽分发内容

* slot
* props：可以在组件上注册的一些自定义 attribute。当一个值传递给一个 prop attribute 的时候，它就变成了那个组件实例的一个 property
  - 父子 prop 之间形成了一个 单向下行绑定：父级 prop 的更新会向下流动到子组件中，但是反过来则不行。这样会防止从子组件意外改变父级组件的状态，从而导致你的应用的数据流向难以理解
* \$children
* data()：必须是一个函数
* created()

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

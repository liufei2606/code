# VUE

- kebab-case (短横线隔开式)

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

- 自定义指令,可以提供如下几个钩子函数
  - bind：只调用一次，指令第一次绑定到元素时调用。在这里可以进行一次性的初始化设置。
  - inserted：被绑定元素插入父节点时调用 (仅保证父节点存在，但不一定已被插入文档中)。
  - update：所在组件的 VNode 更新时调用，但是可能发生在其子 VNode 更新之前。指令的值可能发生了改变，也可能没有。但是你可以通过比较更新前后的值来忽略不必要的模板更新
  - componentUpdated：指令所在组件的 VNode 及其子 VNode 全部更新后调用
  - unbind：只调用一次，指令与元素解绑时调用

## 事件处理

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
- 事件名不存在任何自动化的大小写转换。触发的事件名需要完全匹配监听这个事件所用的名称.始终使用 kebab-case 的事件名
- 事件侦听器
  - 通过 \$on(eventName, eventHandler) 侦听一个事件
  - 通过 \$once(eventName, eventHandler) 一次性侦听一个事件
  - 通过 \$off(eventName, eventHandler) 停止侦听一个事件

## vue 参数

- el:

* computed 计算属性,基于响应式依赖进行缓存,只在相关响应式依赖发生改变时它们才会重新求值
  - 默认只有 getter
* data
  - 只有当实例被创建时就已经存在于 data 中的 property 才是响应式的
  - 使用 Object.freeze()，这会阻止修改现有的 property，也意味着响应系统无法再追踪变化
  - this.\$root.foo
* method:
* mounted
* watch 侦听属性:通用方式来观察和响应 Vue 实例上的数据变动
* components

## 组件

- 复用:每个组件都会各自独立维护它的数据
- 嵌套
- 注册：能在模板中使用，组件必须先注册以便 Vue 能够识别
  - 全局注册:可以用在其被注册之后的任何 (通过 new Vue) 新创建的 Vue 根实例，也包括其组件树中的所有子组件的模板中
  - 局部注册：通过普通的 JavaScript 对象来定义组件，添加到　 compontents
- 子组件可以通过调用内建的 \$emit 方法并传入事件名称来触发一个事件
- 父级组件监听事件时，通过 \$event 访问到被抛出的这个值
- v-modal
- 通过插槽分发内容
- 字符串 (例如：template: '...') 或者　单文件组件 (.vue)，不存在限制
- 模块系统中局部注册
- 在一个组件的根元素上直接监听一个原生事件,使用 v-on 的 .native 修饰符
- \$attrs

* slot:承载分发内容的出口
  - 插槽内可以包含任何模板代码，包括 HTML,甚至其它组件
  - 父级模板里的所有内容都是在父级作用域中编译的；子模板里的所有内容都是在子作用域中编译的
  - 设置具体的后备 (也就是默认的) 内容
  - 有一个特殊的 attribute：name,可以用来定义额外的插槽,不带 name 的 <slot> 出口会带有隐含的名字“default”
  - v-slot|#
  - <keep-alive> 元素将其动态组件包裹起来,第一次被创建的时候缓存下来

- 可以在自己的模板中调用自身的。只能通过 name 选项来做这件事

- 异步组件

* props：可以在组件上注册一些自定义 attribute。当一个值传递给一个 prop attribute 的时候，它就变成了那个组件实例的一个 property
  - 父子 prop 之间形成了一个 单向下行绑定：父级 prop 的更新会向下流动到子组件中，但是反过来则不行。这样会防止从子组件意外改变父级组件的状态，从而导致你的应用的数据流向难以理解
  - 不应该在一个子组件内部改变 prop
  - Prop 验证数据类型
  - 非 Prop 的 Attribute:会被添加到这个组件的根元素上,class 和 style attribute 会稍微智能一些，即两边的值会被合并起来
  - 禁用 Attribute 继承:在组件的选项中设置 `inheritAttrs: false`
* \$children
* data()：必须是一个函数
* created()
* 组件上的 v-model 默认会利用名为 value 的 prop 和名为 input 的事件,但是像单选框、复选框等类型的输入控件可能会将 value attribute 用于不同的目的。model 选项可以用来避免这样的冲突

- 访问父级组件实例:`this.$parent.map` `this.$parent.$parent.map`
- 访问子组件实例或子元素:`this.$refs.usernameInput`
- \$listeners
- 依赖注入:
  - provide 选项允许指定想要提供给后代组件的数据/方法

## 混入 (mixin)

- 提供了一种非常灵活的方式，来分发 Vue 组件中的可复用功能。一个混入对象可以包含任意组件选项。当组件使用混入对象时，所有混入对象的选项将被“混合”进入该组件本身的选项
- 当组件和混入对象含有同名选项时，这些选项将以恰当的方式进行“合并”
- 同名钩子函数将合并为一个数组，都将被调用。混入对象的钩子将在组件自身钩子之前调用
- 可以进行全局注册。使用时格外小心！一旦使用全局混入，将影响每一个之后创建的 Vue 实例

## 虚拟 DOM

- Vue 通过建立一个虚拟 DOM 来追踪自己要如何改变真实 DOM,createNodeDescription，因为它所包含的信息会告诉 Vue 页面上需要渲染什么样的节点，包括及其子节点的描述信息

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

* created()
* 组件上的 v-model 默认会利用名为 value 的 prop 和名为 input 的事件,但是像单选框、复选框等类型的输入控件可能会将 value attribute 用于不同的目的。model 选项可以用来避免这样的冲突
* created()
* 组件上的 v-model 默认会利用名为 value 的 prop 和名为 input 的事件,但是像单选框、复选框等类型的输入控件可能会将 value attribute 用于不同的目的。model 选项可以用来避免这样的冲突

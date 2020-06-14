## [ECMAScript6](https://es6.ruanyifeng.com/#docs/intro)

- ECMAScript 和 JavaScript 的关系:前者是后者的规格，后者是前者的一种实现
- ES6 与 ECMAScript 2015 的关系
  - 标准委员会最终决定，标准在每年的 6 月份正式发布一次，作为当年的正式版本。接下来的时间，就在这个版本的基础上做改动，直到下一年的 6 月份，草案就自然变成了新一年的版本。这样一来，就不需要以前的版本号了，只要用年份标记就可以了
  - ES6 第一个版本，在 2015 年 6 月发布了，正式名称就是《ECMAScript 2015 标准》（简称 ES2015）
  - ES6 既是一个历史名词，也是一个泛指，含义是 5.1 版以后的 JavaScript 的下一代标准，涵盖了 ES2015、ES2016、ES2017 等等，而 ES2015 则是正式名称，特指该年发布的正式版本的语言标准

## [Babel](https://babeljs.io/)

- 一个广泛使用的 ES6 转码器，将 ES6 代码转为 ES5 代码，从而在老版本的浏览器执行
- 配置
  ts 字段设定转码规则
- @babel/cli:命令行工具，用于命令行转码
- @babel/node:提供一个支持 ES6 的 REPL 环境。支持 Node 的 REPL 环境的所有功能，而且可以直接运行 ES6 代码
- @babel/register:改写 require 命令，为它加上一个钩子。此后每当使用 require 加载.js、.jsx、.es 和.es6 后缀名的文件，就会先用 Babel 进行转码.只会对 require 命令加载的文件转码，而不会对当前文件转码。另外，由于它是实时转码，所以只适合在开发环境使用
- polyfill
  - 只转换新的 JavaScript 句法（syntax），而不转换新的 API，比如 Iterator、Generator、Set、Map、Proxy、Reflect、Symbol、Promise 等全局对象，以及一些定义在全局对象上的方法（比如 Object.assign）都不会转码
  - 使用 core-js 和 regenerator-runtime(后者提供 generator 函数的转码)，为当前环境提供一个垫片
- 使用@babel/standalone 模块提供的浏览器版本，将其插入网页.网页实时将 ES6 代码转为 ES5

```
npm install --save-dev @babel/core
# 最新转码规则
npm install --save-dev @babel/preset-env
# react 转码规则
npm install --save-dev @babel/preset-react

npm install --save-dev @babel/cli

# .babelrc
{
"presets": [
    "@babel/env",
    "@babel/preset-react"
],
"plugins": []
}

npx babel example.js --out-file|-o compiled.js
npx babel src --out-dir|-d lib
npm install --save-dev @babel/node
npx babel-node # 进入 REPL 环境
npx babel-node es6.js

npm install --save-dev @babel/register

npm install --save-dev core-js regenerator-runtime

import 'core-js';
import 'regenerator-runtime/runtime';
// 或者
require('core-js');
require('regenerator-runtime/runtime);
```

## 变量

- let:只在 let 命令所在的代码块内有效

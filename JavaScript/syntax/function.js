// 声明方法
function abs(x) {
	if (x >= 0) {
		return x;
	} else {
		return -x;
	}
}

var f = function f(x, y, z) {
	return x * (y - z);
};

var f = new Function("x", "y", "return x*y;");

function foo() {
	var x = 'Hello, ' + y;
	alert(x);
	var y = 'Bob';
}
foo(); //  Hello, undefined

function foo() {
	var
		x = 1, // x初始化为1
		y = x + 1, // y初始化为2
		z, i; // z和i为undefined
	// 其他语句:
	for (i = 0; i < 100; i++) {}
}

function foo() {
	if (arguments.length === 0) {
		return 0;
	}
	var x = arguments[0];
	return x >= 0 ? x : -x;
}
foo(-9);

function foo(a, b, ...rest) {
	console.log('a = ' + a);
	console.log('b = ' + b);
	console.log(rest);
}

foo(1, 2, 3, 4, 5);


f.call(o, 1, 2);
f.apply(o, [1, 2]);

// 作用域
var a = 1;
var x = function () {
	console.log(a);
};

function f() {
	var a = 2;
	x();
}

f() // 1

var x = function () {
	console.log(a);
};

function y(f) {
	var a = 2;
	f();
}

y(x)
// ReferenceError: a is not defined


function foo() {
	var x = 1;

	function bar() {
		console.log(x);
	}
	return bar;
}

var x = 2;
var f = foo();
f() // 1

// 参数
function f(a, b) {
	return a;
}

f(1, 2, 3) // 1
f(1) // 1
f() // undefined

// 引用传递
var obj = {
	p: 1
};

function f(o) {
	o.p = 2;
}
f(obj);

obj.p // 2

var obj = [1, 2, 3];

function f(o) {
	o = [2, 3, 4];
}
f(obj);

obj // [1, 2, 3]

function f(a, a) {
	console.log(a);
}

f(1) // undefined

var f = function (a, b) {
	arguments[0] = 3;
	arguments[1] = 2;
	return a + b;
}

f(1, 1) // 5

var f = function (a, b) {
	'use strict'; // 开启严格模式
	arguments[0] = 3;
	arguments[1] = 2;
	return a + b;
}

f(1, 1) // 2

// 将arguments转为真正的数组
var args = Array.prototype.slice.call(arguments);

// 或者
var args = [];
for (var i = 0; i < arguments.length; i++) {
	args.push(arguments[i]);
}

// 编写一个工具函数将类数组对象转化为真正的数组
function array(a, n) {
	return Array.prototype.slice.call(a, n || 0);
}

// 这个不完全函数实现参数传递至左侧
function partial_left(f /*,...*/ ) {
	var args = arguments; // 保存外部实参数组
	return function () {
		var a = array(args, 1); // 定义一个实参列表，将外部参数排除第一个参数（函数f）后作为初始值
		a = a.concat(array(arguments)); // 然后将所有内部参数添加到这个实参列表
		return f.apply(this, a); // 最后基于这个实参列表调用函数 f()
	}
}

// 这个不完全函数实现参数传递至右侧
function partial_right(f /*,...*/ ) {
	var args = arguments;
	return function () {
		var a = array(arguments); // 定义一个实参列表，将内部参数作为初始值
		a = a.concat(array(args, 1)); // 排除外部参数第一个参数（函数f()）后将其余参数添加到实参列表
		return f.apply(this, a); // 最后基于这个实参列表调用函数 f()
	}
}

// 这个不完全函数的实参被用作模板，实参列表中的undefined值被内部参数填充
function partial(f /*,...*/ ) {
	var args = arguments;
	return function () {
		var a = array(args, 1); // 定义一个实参列表，将外部参数排除第一个参数（函数f）后作为初始值
		var i = 0,
			j = 0;
		// 遍历 args 用内部参数填充外部参数 undefined 值
		for (; i < a.length; i++) {
			if (a[i] === undefined)
				a[i] = arguments[j++];
		}
		// 现在将剩下的内部参数都放进去
		a = a.concat(array(arguments, j));
		return f.apply(this, a);
	}
}

var f = function f() {
	return 1
}();
f // 1

	(function () {
		var tmp = newData;
		processData(tmp);
		storeData(tmp);
	}());

// 因为return不能单独使用，必须在函数中使用。
eval('return;'); // Uncaught SyntaxError: Illegal return statement

var a = 1;
eval('a = 2');

a // 2

	(function f() {
		'use strict';
		eval('var foo = 123');
		console.log(foo); // ReferenceError: foo is not defined
	})()

(function f() {
	'use strict';
	var foo = 1;
	eval('foo = 2');
	console.log(foo); // 2
})()

function f() {
	function f() {
		if (!new.target) {
			throw new Error('请使用 new 命令调用！');
		}
		// ...
	}
	console.log(new.target === f);
}

f() // false
new f() // true

var obj = {
	foo: function () {
		console.log(this);
	}
};

obj.foo() // obj
// 情况一
(obj.foo = obj.foo)() // window
// 情况二
(false || obj.foo)() // window
// 情况三
(1, obj.foo)() // window

var a = {
	p: 'Hello',
	b: {
		m: function () {
			console.log(this.p);
		}
	}
};

a.b.m() // undefined

var b = {
	m: function () {
		console.log(this.p);
	}
};

var a = {
	p: 'Hello',
	b: b
};

(a.b).m() // 等同于 b.m()

var a = {
	b: {
		m: function () {
			console.log(this.p);
		},
		p: 'Hello'
	}
};

var hello = a.b.m;
hello() // undefined

var obj = {};

var f = function () {
	return this;
};

f() === window // true
f.call(obj) === obj // true

var n = 123;
var obj = {
	n: 456
};

// 绑定 this
function a() {
	console.log(this.n);
}

a.call() // 123
a.call(null) // 123
a.call(undefined) // 123
a.call(window) // 123
a.call(obj) // 456

function add(a, b) {
	return a + b;
}

add.call(this, 1, 2) // 3

var obj = {};
obj.hasOwnProperty('toString') // false

// 覆盖掉继承的 hasOwnProperty 方法
obj.hasOwnProperty = function () {
	return true;
};
obj.hasOwnProperty('toString') // true

Object.prototype.hasOwnProperty.call(obj, 'toString') // false

function f(x, y) {
	console.log(x + y);
}

f.call(null, 1, 1) // 2
f.apply(null, [1, 1]) // 2

var a = [10, 2, 4, 15, 9];
Math.max.apply(null, a) // 15

// forEach方法会跳过空元素，但是不会跳过undefined
var a = ['a', , 'b'];

function print(i) {
	console.log(i);
}

a.forEach(print)
// a
// b
Array.apply(null, a)
// a
// undefined
// b


Array.prototype.slice.apply({
	0: 1,
	length: 1
}) // [1]
Array.prototype.slice.apply({
	0: 1
}) // []
Array.prototype.slice.apply({
	0: 1,
	length: 2
}) // [1, undefined]
Array.prototype.slice.apply({
	length: 1
}) // [undefined]

var o = new Object();

o.f = function () {
	console.log(this === o);
}

var f = function () {
	o.f.apply(o);
	// 或者 o.f.call(o);
};

// jQuery 的写法
$('#button').on('click', f);

var d = new Date();
d.getTime() // 1481869925657
var print = d.getTime.bind(d);
print() // 1481869925657

var counter = {
	count: 0,
	inc: function () {
		this.count++;
	}
};

var func = counter.inc.bind(counter);
func();
counter.count // 1

// bind 到其它对象
var obj = {
	count: 100
};
var func = counter.inc.bind(obj);
func();
obj.count // 101

var add = function (x, y) {
	return x * this.m + y * this.n;
}

var obj = {
	m: 2,
	n: 2
};

var newAdd = add.bind(obj, 5);
newAdd(5) // 20

function add(x, y) {
	return x + y;
}

var plus5 = add.bind(null, 5);
plus5(10) // 15

var listener = o.m.bind(o);
element.addEventListener('click', listener);
//  ...
element.removeEventListener('click', listener);

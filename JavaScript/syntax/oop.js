var Vehicle = function (p) {
	'use strict';
	this.price = p;
};

var v = new Vehicle(500);

function Fubar(foo, bar) {
	if (!(this instanceof Fubar)) {
		return new Fubar(foo, bar);
	}

	this._foo = foo;
	this._bar = bar;
}

Fubar(1, 2)._foo // 1
(new Fubar(1, 2))._foo // 1

var person1 = {
	name: '张三',
	age: 38,
	greeting: function () {
		console.log('Hi! I\'m ' + this.name + '.');
	}
};

var person2 = Object.create(person1);

person2.name // 张三
person2.greeting() // Hi! I'm 张三.

function f() {
	return '姓名：' + this.name;
}

var A = {
	name: '张三',
	describe: f
};

var B = {
	name: '李四',
	describe: f
};

A.describe() // "姓名：张三"
B.describe() // "姓名：李四"


var A = {
	name: '张三',
	describe: function () {
		return '姓名：' + this.name;
	}
};

var name = '李四';
var f = A.describe;
// 内部的this就会指向f运行时所在的对象，本例是顶层对象
f() // "姓名：李四"

// 函数切换上下文环境
var f = function () {
	console.log(this.x);
}

var x = 1;
var obj = {
	f: f,
	x: 2,
};

// 单独执行
f() // 1

// obj 环境执行
obj.f() // 2

this === window // true

function f() {
	console.log(this === window);
}
f() // true

// prototype
function Animal(name) {
	this.name = name;
}
Animal.prototype.color = 'white';

var cat1 = new Animal('大毛');
var cat2 = new Animal('二毛');

cat1.color // 'white'
cat2.color // 'white'

// constructor() 被所有实例对象继承
function P() {}
var p = new P();

p.constructor === P // true
p.constructor === P.prototype.constructor // true
p.hasOwnProperty('constructor') // false

function Person(name) {
	this.name = name;
}

Person.prototype.constructor === Person // true

Person.prototype = {
	method: function () {}
};

Person.prototype.constructor === Person // false
Person.prototype.constructor === Object // true

// 好的写法
C.prototype = {
	constructor: C,
	method1: function () {},

};

// 更好的写法
C.prototype.method1 = function () {};

var obj = Object.create(null);
typeof obj // "object"
Object.create(null) instanceof Object // false

// 巧妙地解决，调用构造函数时，忘了加new命令的问题
function Fubar(foo, bar) {
	if (this instanceof Fubar) {
		this._foo = foo;
		this._bar = bar;
	} else {
		return new Fubar(foo, bar);
	}
}

function Sub(value) {
	Super.call(this);
	this.prop = value;
}

// 不是直接等于Super.prototype。否则后面对Sub.prototype的操作，会连父类的原型Super.prototype一起修改掉
Sub.prototype = Object.create(Super.prototype);
Sub.prototype.constructor = Sub;

function Shape() {
	this.x = 0;
	this.y = 0;
}

Shape.prototype.move = function (x, y) {
	this.x += x;
	this.y += y;
	console.info('Shape moved.');
};

// 第一步，子类继承父类的实例
function Rectangle() {
	Shape.call(this); // 调用父类构造函数
}
// 另一种写法
function Rectangle() {
	this.base = Shape;
	this.base();
}

// 第二步，子类继承父类的原型
Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;

// 多重继承
function M1() {
	this.hello = 'hello';
}

function M2() {
	this.world = 'world';
}

function S() {
	M1.call(this);
	M2.call(this);
}

// 继承 M1
S.prototype = Object.create(M1.prototype);
// 继承链上加入 M2
Object.assign(S.prototype, M2.prototype);

// 指定构造函数
S.prototype.constructor = S;

var s = new S();
s.hello // 'hello'
s.world // 'world'

// 空对象的原型是 Object.prototype
Object.getPrototypeOf({}) === Object.prototype // true

// Object.prototype 的原型是 null
Object.getPrototypeOf(Object.prototype) === null // true

// 函数的原型是 Function.prototype
function f() {}
Object.getPrototypeOf(f) === Function.prototype // true

var a = {};
var b = {
	x: 1
};
Object.setPrototypeOf(a, b);

Object.getPrototypeOf(a) === b // true
a.x // 1

var obj = Object.create({}, {
	p1: {
		value: 123,
		enumerable: true,
		configurable: true,
		writable: true,
	},
	p2: {
		value: 'abc',
		enumerable: true,
		configurable: true,
		writable: true,
	}
});

// 等同于
var obj = Object.create({});
obj.p1 = 123;
obj.p2 = 'abc';

Object.getOwnPropertyNames(Date)

// 对象拷贝
function copyObject(orig) {
	var copy = Object.create(Object.getPrototypeOf(orig));
	copyOwnPropertiesFrom(copy, orig);
	return copy;
}

function copyOwnPropertiesFrom(target, source) {
	Object
		.getOwnPropertyNames(source)
		.forEach(function (propKey) {
			var desc = Object.getOwnPropertyDescriptor(source, propKey);
			Object.defineProperty(target, propKey, desc);
		});
	return target;
}

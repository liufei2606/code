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

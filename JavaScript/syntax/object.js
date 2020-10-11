var person = {
	firstname: 'John',
	lastname: 'Doe',
	age: 50,
	eyecolor: 'blue'
};
name = person.lastname;
name = person['lastname'];

var obj = {
	1: 'a',
	3.2: 'b',
	1e2: true,
	1e-2: true,
	.234: true,
	0xFF: true
};

obj
// Object {
//   1: "a",
//   3.2: "b",
//   100: true,
//   0.01: true,
//   0.234: true,
//   255: true
// }

var person1 = new Object;
var person1 = {
	name: 'Bob',
	age: 20,
	tags: ['js', 'web', 'mobile'],
	city: 'Beijing',
	hasCar: true,
	'middle-school': 'No.1 Middle School',
	zipcode: null,
};

person1.name; // 获取
person1.zipcode; // null
person1.address; // undefined
person1['middle-school']; // 另外一种寻址方式
person1.address = 'shanghai'
delete person1.address

'name' in person;
toString in
	xiaoming; // true
// 因为toString定义在object对象中，而所有对象最终都会在原型链上指向object
person.hasOwnProperty('name'); // true
person.hasOwnProperty('toString'); // false

function person2(firstname, lastname, age, eyecolor) {
	this.firstname = firstname;
	this.lastname = lastname;
	this.age = age;
	this.eyecolor = eyecolor;

	this.changeName = changeName;

	function changeName(name) {
		this.lastname = name;
	}

	fullName: function () {
		return this.firstName + ' ' + this.lastName;
	}
}
var myMother = new person2('Steve', 'Jobs', 48, 'green');
myMother.fullName();

var xiaoming = {
	name: '小明',
	birth: 1990,
	age: function () {
		var y = new Date().getFullYear();
		return y - this.birth;
	}
};

eval('{foo: 123}') // 123
eval('({foo: 123})') // {foo: 123}


var obj = Object.defineProperty({}, 'p', {
	value: 123,
	configurable: false
});

obj.p // 123
delete obj.p // false

var obj = {
	p: 1
};

'p' in obj // true
	'toString' in obj // true

if ('toString' in obj) {
	console.log(obj.hasOwnProperty('toString')) // false
}

for (var i in obj) {
	if (person.hasOwnProperty(key)) {
		console.log('键名：', i);
		console.log('键值：', obj[i]);
	}
}

var obj = {
	p1: 1,
	p2: 2,
};
with(obj) {
	p1 = 4;
	p2 = 5;
}
// 等同于
obj.p1 = 4;
obj.p2 = 5;

// 例二
with(document.links[0]) {
	console.log(href);
	console.log(title);
	console.log(style);
}
// 等同于
// console.log(document.links[0].href);
// console.log(document.links[0].title);
// console.log(document.links[0].style);

var obj = {};
with(obj) {
	p1 = 4;
	p2 = 5;
}

obj.p1 // undefined
p1 // 4


xiaoming.age; // function xiaoming.age()
xiaoming.age(); // 今年调用是25,明年调用就变成26了
var fn = xiaoming.age; // 先拿到xiaoming的age函数
fn(); // NaN // strict模式下 Uncaught TypeError: Cannot read property 'birth'
// of undefined

'use strict';
var xiaoming = {
	name: '小明',
	birth: 1990,
	age: function () {
		function getAgeFromBirth() {
			var y = new Date().getFullYear();
			return y - this.birth;
		}
		return getAgeFromBirth();
	}
};

xiaoming
	.age(); // Uncaught TypeError: Cannot read property 'birth' of undefined
// 报错了！原因是this指针只在age方法的函数内指向xiaoming，在函数内部定义的函数，this又指向undefined了！（在非strict模式下，它重新指向全局对象window！）

'use strict';
var xiaoming = {
	name: '小明',
	birth: 1990,
	age: function () {
		var that = this; // 在方法内部一开始就捕获this
		function getAgeFromBirth() {
			var y = new Date().getFullYear();
			return y - that.birth; // 用that而不是this
		}
		return getAgeFromBirth();
	}
};

xiaoming.age(); // 25

function getAge() {
	var y = new Date().getFullYear();
	return y - this.birth;
}

var xiaoming = {
	name: '小明',
	birth: 1990,
	age: getAge
};

for (x in xiaoming) {
	txt = txt + person[x];
}

xiaoming.age(); // 25
getAge.apply(xiaoming, []); // 25, this指向xiaoming, 参数为空

Math.max.apply(null, [3, 5, 4]); // 5
Math.max.call(null, 3, 5, 4); // 5

// 想统计一下代码一共调用了多少次parseInt()
var count = 0;
var oldParseInt = parseInt; // 保存原函数

window.parseInt = function () {
	count += 1;
	return oldParseInt.apply(null, arguments); // 调用原函数
};

// 测试:
parseInt('10');
parseInt('20');
parseInt('30');
count; // 3


function employee(name, jobtitle, born) {
	this.name = name;
	this.jobtitle = jobtitle;
	this.born = born;
}
var fred = new employee('Fred Flintstone', 'Caveman', 1970);
employee.prototype.salary = null;
fred.salary = 20000;
document.write(fred.salary);


class Student {
	constructor(name) {
		this.name = name;
	}

	hello() {
		alert('Hello, ' + this.name + '!');
	}
}
var xiaoming = new Student('小明');
xiaoming.hello();

class PrimaryStudent extends Student {
	constructor(name, grade) {
		super(name); // 记得用super调用父类的构造方法!
		this.grade = grade;
	}

	myGrade() {
		alert('I am at grade ' + this.grade);
	}
}


function Student(name) {
	this.name = name;
	this.hello = function () {
		alert('Hello, ' + this.name + '!');
	}
}

// 原型链：xiaoming ----> Student.prototype ----> Object.prototype ----> null
var xiaoming = new Student('小明');
xiaoming.name; // '小明'
xiaoming.hello(); // Hello, 小明!

xiaoming.constructor === Student.prototype.constructor; // true
Student.prototype.constructor === Student; // true
Object.getPrototypeOf(xiaoming) === Student.prototype; // true
xiaoming instanceof Student; // true

xiaoming.hello === xiaohong.hello; // false

function Student(name) {
	this.name = name;
}

Student.prototype.hello = function () {
	alert('Hello, ' + this.name + '!');
};

// 升级
function Student(props) {
	this.name = props.name || '匿名'; // 默认值为'匿名'
	this.grade = props.grade || 1; // 默认值为1
}

Student.prototype.hello = function () {
	alert('Hello, ' + this.name + '!');
};

function createStudent(props) {
	return new Student(props || {})
}
var xiaoming = createStudent({
	name: '小明'
});
xiaoming.grade;

var point = {
	x: 1,
	y: 2
};
var r = new RegExp('laravel');

var o2 = Object.create(Object.prototype);

Object.getOwnPropertyDescriptor({
	x: 1
}, 'x')
Object.getOwnPropertyDescriptor({
	x: 1
}, 'toString')
Object.defineProperty({}, 'x', {
	value: 1,
	writable: true,
	enumerable: true,
	configurable: true
})


// range.js 实现了一个能表示值的范围的类

// 通过该方法定义继承自原型 p 的新对象
function inherit(p) {
	if (p == null) throw TypeError();
	if (Object.create)
		return Object.create(p);
	var t = typeof p;
	if (t !== 'function' && t !== 'object') throw TypeError();

	function f() {};
	f.prototype = p;
	return new f();
}

// 这个工厂方法返回一个新的「范围对象」
function range(from, to) {
	// 使用 inherit 函数来创建对象，这个对象继承自下面定义的原型对象
	// 原型对象作为函数的一个属性存储，并定义所有「范围对象」所共享的方法
	var r = inherit(range.methods);

	// 存储新的「范围对象」的起始位置和结束位置
	// 这两个属性是不可继承的，每个对象都拥有唯一属性
	r.from = from;
	r.to = to;

	// 返回这个新创建的对象
	return r;
}

// 原型对象定义方法，这些方法为每个范围对象所继承
range.methods = {
	// 如果 x 在范围内，返回 true，否则返回 false
	// 这个方法可以比较数字范围，也可以比较字符串和日期范围
	includes: function (x) {
		return this.from <= x && x <= this.to;
	},

	// 对于范围内的每个整数都调用一次f
	// 这个方法只用作数字范围
	foreach: function (f) {
		for (var x = Math.ceil(this.from); x <= this.to; x++) {
			f(x);
		}
	},

	// 返回表示这个范围的字符串
	toString: function () {
		return "(" + this.from + "..." + this.to + ")";
	}
};

//  Object 对象
Object.print = function (o) {
	console.log(o)
};

// 工具函数
var obj = Object();
// 等同于
var obj = Object(undefined);
var obj = Object(null);

obj instanceof Object // true

var obj = Object(1);
obj instanceof Object // true
obj instanceof Number // true

var obj = Object('foo');
obj instanceof Object // true
obj instanceof String // true

var obj = Object(true);
obj instanceof Object // true
obj instanceof Boolean // true

// 构造函数
var obj = new Object();
// var obj = {}是等价

// Object.keys()和Object.getOwnPropertyNames() 区别
var a = ['Hello', 'World'];
Object.keys(a) // ["0", "1"]
Object.getOwnPropertyNames(a) // ["0", "1", "length"]

// 实例方法
Object.prototype.print = function () {
	console.log(this);
};

var obj = new Object();
obj.print() // Object

var obj = new Object();
obj.valueOf() === obj // true

// toString 重写
[1, 2, 3].toString() // "1,2,3"

'123'.toString() // "123"

(function () {
	return 123;
}).toString()
// "function () {
//   return 123;
// }"

(new Date()).toString()
// "Tue May 10 2016 09:11:31 GMT+0800 (CST)"

// 判断数据类型
Object.prototype.toString.call(2) // "[object Number]"
Object.prototype.toString.call('') // "[object String]"
Object.prototype.toString.call(true) // "[object Boolean]"
Object.prototype.toString.call(undefined) // "[object Undefined]"
Object.prototype.toString.call(null) // "[object Null]"
Object.prototype.toString.call(Math) // "[object Math]"
Object.prototype.toString.call({}) // "[object Object]"
Object.prototype.toString.call([]) // "[object Array]"

var type = function (o) {
	var s = Object.prototype.toString.call(o);
	return s.match(/\[object (.*?)\]/)[1].toLowerCase();
};

type({}); // "object"
type([]); // "array"
type(5); // "number"
type(null); // "null"
type(); // "undefined"
type(/abcd/); // "regex"
type(new Date()); // "date"

['Null',
	'Undefined',
	'Object',
	'Array',
	'String',
	'Number',
	'Boolean',
	'Function',
	'RegExp'
].forEach(function (t) {
	type['is' + t] = function (o) {
		return type(o) === t.toLowerCase();
	};
});

type.isObject({}) // true
type.isNumber(NaN) // true
type.isRegExp(/abc/) // true

var person = {
	toString: function () {
		return 'Henry Norman Bethune';
	},
	toLocaleString: function () {
		return '白求恩';
	}
};

person.toString() // Henry Norman Bethune
person.toLocaleString() // 白求恩

var date = new Date();
date.toString() // "Tue Jan 01 2018 12:01:33 GMT+0800 (CST)"
date.toLocaleString() // "1/01/2018, 12:01:33 PM"

var obj = {
	p: 123
};

obj.hasOwnProperty('p') // true
obj.hasOwnProperty('toString') // false

var obj = {
	p: 'a'
};
Object.getOwnPropertyDescriptor(obj, 'p')

var obj = Object.defineProperties({}, {
	p1: {
		value: 1,
		enumerable: true
	},
	p2: {
		value: 2,
		enumerable: false
	}
});

Object.getOwnPropertyNames(obj)

var obj = Object.defineProperty({}, 'p', {
	value: 123,
	writable: false,
	enumerable: true,
	configurable: false
});

obj.p // 123

obj.p = 246;
obj.p // 123

var obj = Object.defineProperties({}, {
	p1: {
		value: 123,
		enumerable: true
	},
	p2: {
		value: 'abc',
		enumerable: true
	},
	p3: {
		get: function () {
			return this.p1 + this.p2
		},
		enumerable: true,
		configurable: true
	}
});

obj.p1 // 123
obj.p2 // "abc"
obj.p3 // "123abc"

var obj = {};

Object.defineProperty(obj, 'p', {
	value: 123,
	get: function () {
		return 456;
	}
});
// TypeError: Invalid property.
// A property cannot both have accessors and be writable or have a value

Object.defineProperty(obj, 'p', {
	writable: true,
	get: function () {
		return 456;
	}
});
// TypeError: Invalid property descriptor.
// Cannot both specify accessors and a value or writable

var obj = {};
obj.p = 123;

obj.propertyIsEnumerable('p') // true
obj.propertyIsEnumerable('toString') // false

// 元属性
var obj = {};
obj.p = 123;

Object.getOwnPropertyDescriptor(obj, 'p').value
// 123

Object.defineProperty(obj, 'p', {
	value: 246
});
obj.p // 246

var obj = {};

Object.defineProperty(obj, 'a', {
	value: 37,
	writable: false
});

obj.a // 37
obj.a = 25;
obj.a // 37

//  绕过 writable 限制
var proto = Object.defineProperty({}, 'foo', {
	value: 'a',
	writable: false
});

var obj = Object.create(proto);

obj.foo = 'b';
obj.foo // 'a'
Object.defineProperty(obj, 'foo', {
	value: 'b'
});

obj.foo // "b"


var obj = Object.defineProperty({}, 'p', {
	value: 1,
	writable: false,
	enumerable: false,
	configurable: false
});

Object.defineProperty(obj, 'p', {
	value: 2
})
// TypeError: Cannot redefine property: p

Object.defineProperty(obj, 'p', {
	writable: true
})
// TypeError: Cannot redefine property: p

Object.defineProperty(obj, 'p', {
	enumerable: true
})
// TypeError: Cannot redefine property: p

Object.defineProperty(obj, 'p', {
	configurable: true
})
// TypeError: Cannot redefine property: p

var obj = Object.defineProperty({}, 'p', {
	get: function () {
		return 'getter';
	},
	set: function (value) {
		console.log('setter: ' + value);
	}
});

obj.p // "getter"
obj.p = 123 // "setter: 123"

// 属性p的configurable和enumerable都为true，因此属性p是可遍历的
var obj = {
	get p() {
		return 'getter';
	},
	set p(value) {
		console.log('setter: ' + value);
	}
};

var obj = {
	$n: 5,
	get next() {
		return this.$n++
	},
	set next(n) {
		if (n >= this.$n) this.$n = n;
		else throw new Error('新的值必须大于当前值');
	}
};

obj.next // 5

obj.next = 10;
obj.next // 10

obj.next = 5;
// Uncaught Error: 新的值必须大于当前值

// 如果遇到存取器定义的属性，会只拷贝值
var extend = function (to, from) {
	for (var property in from) {
		to[property] = from[property];
	}

	return to;
}

extend({}, {
	a: 1
})

// 改进
var extend = function (to, from) {
	for (var property in from) {
		if (!from.hasOwnProperty(property)) continue;
		Object.defineProperty(
			to,
			property,
			Object.getOwnPropertyDescriptor(from, property)
		);
	}

	return to;
}

extend({}, {
	get a() {
		return 1
	}
})
// { get a(){ return 1 } })

var obj = new Object();
Object.preventExtensions(obj);

Object.defineProperty(obj, 'p', {
	value: 'hello'
});
// TypeError: Cannot define property:p, object is not extensible.

obj.p = 1;
obj.p // undefined

var obj = new Object();

Object.isExtensible(obj) // true
Object.preventExtensions(obj);
Object.isExtensible(obj) // false

var obj = {
	p: 'hello'
};
Object.getOwnPropertyDescriptor(obj, 'p')
Object.seal(obj);
Object.getOwnPropertyDescriptor(obj, 'p')
Object.isSealed(obj) // true
delete obj.p;
obj.p // "hello"

obj.x = 'world';
obj.x // undefined


var obj = {
	p: 'hello'
};

Object.freeze(obj);
Object.isFrozen(obj) // true
obj.p = 'world';
obj.p // "hello"

obj.t = 'hello';
obj.t // undefined

delete obj.p // false
obj.p // "hello"

var obj = {
	foo: 1,
	bar: ['a', 'b']
};
Object.freeze(obj);

obj.bar.push('c');
obj.bar // ["a", "b", "c"]

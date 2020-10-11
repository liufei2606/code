var cars = new Array();
cars[0] = "Audi";
cars[1] = "BMW";
cars[2] = "Volvo";
var cars = new Array("Saab", "Volvo", "BMW"); // condensed array
var cars = ["Audi", "BMW", "Volvo"]; // literal array

var arr = [];

arr[0] = 'a';
arr[1] = 'b';
arr[2] = 'c';

arr = [{
		a: 1
	},
	[1, 2, 3],
	function () {
		return true;
	}
];

var arr = [1, 2, 3.14, 'Hello', null, true];
arr.length; // 6
arr[0]; // 返回索引为0的元素，即1
arr[5]; // 返回索引为5的元素，即true
arr[6]; // 索引超出了范围，返回undefined

new Array('abc') // ['abc']

arr.length = 7; // arr变为[1, 2, 3.14, 'Hello', null, true, undefined]
arr.length = 2; // arr变为[1, 2]

arr[1] = 99; // 修改值

arr[5] = 'x'; // arr变为[1, 2, 3, undefined, undefined, 'x']

arr.indexOf(30); // 元素30没有找到，返回-1
arr.indexOf('30'); // 元素'30'的索引为2

var arr = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
arr.slice(0, 3); // 从索引0开始，到索引3结束，但不包括索引3: ['A', 'B', 'C']
arr.slice(3); // 从索引3开始到结束: ['D', 'E', 'F', 'G']
var aCopy = arr.slice();

var arr = [1, 2];
arr.push('A', 'B'); // 返回Array新的长度: 4 [1, 2, 'A', 'B']
arr.pop(); // pop()返回'B' [1, 2, 'A']
arr.pop();
arr.pop();
arr.pop(); // 连续pop 3次  []
arr.pop(); // 空数组继续pop不会报错，而是返回undefined

var arr = [1, 2];
arr.unshift('A', 'B'); // 返回Array新的长度: 4  ['A', 'B', 1, 2]
arr.shift(); // 'A' ['B', 1, 2]
arr.shift();
arr.shift();
arr.shift(); // 连续shift 3次  []
arr.shift(); // 空数组继续shift不会报错，而是返回undefined []

var arr = ['Microsoft', 'Apple', 'Yahoo', 'AOL', 'Excite', 'Oracle'];
// 从索引2开始删除3个元素,然后再添加两个元素:
arr.splice(2, 3, 'Google', 'Facebook'); // 返回删除的元素 ['Yahoo', 'AOL', 'Excite']
arr; // ['Microsoft', 'Apple', 'Google', 'Facebook', 'Oracle']
// 只删除,不添加:
arr.splice(2, 2); // ['Google', 'Facebook']
arr; // ['Microsoft', 'Apple', 'Oracle']
// 只添加,不删除:
arr.splice(2, 0, 'Google', 'Facebook'); // 返回[],因为没有删除任何元素
arr; // ['Microsoft', 'Apple', 'Google', 'Facebook', 'Oracle']

var arr = ['A', 'B', 'C'];
var added = arr.concat([1, 2, 3]);
added; // ['A', 'B', 'C', 1, 2, 3]
arr; // ['A', 'B', 'C']
var arr = ['A', 'B', 'C'];
arr.concat(1, 2, [3, 4]); // ['A', 'B', 'C', 1, 2, 3, 4]

var arr = ['A', 'B', 'C', 1, 2, 3];
arr.join('-'); // 'A-B-C-1-2-3'

var x
var mycars = new Array()
mycars[0] = "Saab"
mycars[1] = "Volvo"
mycars[2] = "BMW"

for (x in mycars) {
	document.write(mycars[x] + "<br />")
}

var colors = ['red', 'green', 'blue'];
colors.forEach(function (color) {
	console.log(color);
});

var a = [, , , ];

a.forEach(function (x, i) {
	console.log(i + '. ' + x);
})
// 不产生任何输出

for (var i in a) {
	console.log(i);
}
// 不产生任何输出

Object.keys(a)
// []

var a = [undefined, undefined, undefined];

a.forEach(function (x, i) {
	console.log(i + '. ' + x);
});
// 0. undefined
// 1. undefined
// 2. undefined

for (var i in a) {
	console.log(i);
}
// 0
// 1
// 2

Object.keys(a)
// ['0', '1', '2']

// 类似数组的对象
// arguments对象
function args() {
	return arguments
}
var arrayLike = args('a', 'b');

arrayLike[0] // 'a'
arrayLike.length // 2
arrayLike instanceof Array // false

// DOM元素集
var elts = document.getElementsByTagName('h3');
elts.length // 3
elts instanceof Array // false

	// 字符串
	'abc' [1] // 'b'
'abc'.length // 3
	'abc'
instanceof Array // false

// 将“类似数组的对象”变成真正的数组
var arr = Array.prototype.slice.call(arrayLike);

// 使用数组方法
function print(value, index) {
	console.log(index + ' : ' + value);
}

Array.prototype.forEach.call(arrayLike, print);

function logArgs() {
	Array.prototype.forEach.call(arguments, function (elem, i) {
		console.log(i + '. ' + elem);
	});
}

Array.prototype.forEach.call('abc', function (chr) {
	console.log(chr);
});


var list = [1, 2, 3, 4];
var item;

while (item = list.shift()) {
	console.log(item);
}

list // []


var a = [1, 2, 3, 4];

a.join(' ') // '1 2 3 4'
a.join(' | ') // "1 | 2 | 3 | 4"
a.join() // "1,2,3,4"

['hello'].concat(['world'])
// ["hello", "world"]

['hello'].concat(['world'], ['!'])
// ["hello", "world", "!"]

[].concat({
	a: 1
}, {
	b: 2
})
// [{ a: 1 }, { b: 2 }]

[2].concat({
	a: 1
})
// [2, {a: 1}]

var obj = {
	a: 1
};
var oldArray = [obj];

var newArray = oldArray.concat();

obj.a = 2;
newArray[0].a // 2

Array.prototype.slice.call({
	0: 'a',
	1: 'b',
	length: 2
})
// ['a', 'b']

Array.prototype.slice.call(document.querySelectorAll("div"));
Array.prototype.slice.call(arguments);

[10111, 1101, 111].sort(function (a, b) {
	return a - b;
})
// [111, 1101, 10111]

[{
	name: "张三",
	age: 30
}, {
	name: "李四",
	age: 24
}, {
	name: "王五",
	age: 28
}].sort(function (o1, o2) {
	return o1.age - o2.age;
})
// [
//   { name: "李四", age: 24 },
//   { name: "王五", age: 28  },
//   { name: "张三", age: 30 }
// ]

[1, 2, 3].map(function (elem, index, arr) {
	return elem * index;
});
// [0, 2, 6]

var arr = ['a', 'b', 'c'];

[1, 2].map(function (e) {
	return this[e];
}, arr)
// ['b', 'c']

function log(element, index, array) {
	console.log('[' + index + '] = ' + element);
}

[2, 5, 9].forEach(log);
// [0] = 2
// [1] = 5
// [2] = 9

var out = [];

[1, 2, 3].forEach(function (elem) {
	this.push(elem * elem);
}, out);

out // [1, 4, 9]

var log = function (n) {
	console.log(n + 1);
};

[1, undefined, 2].forEach(log)
// 2
// NaN
// 3

[1, null, 2].forEach(log)
// 2
// 1
// 3

[1, , 2].forEach(log)
// 2
// 3

[1, 2, 3, 4, 5].filter(function (elem) {
	return (elem > 3);
})
// [4, 5]

[1, 2, 3, 4, 5].filter(function (elem, index, arr) {
	return index % 2 === 0;
});
// [1, 3, 5]

var obj = {
	MAX: 3
};
var myFilter = function (item) {
	if (item > this.MAX) return true;
};

var arr = [2, 8, 3, 4, 1, 3, 2, 9];
arr.filter(myFilter, obj) // [8, 4, 9]

var arr = [1, 2, 3, 4, 5];
arr.some(function (elem, index, arr) {
	return elem >= 3;
});
// true

var arr = [1, 2, 3, 4, 5];
arr.every(function (elem, index, arr) {
	return elem >= 3;
});
// false

[1, 2, 3, 4, 5].reduce(function (a, b) {
	console.log(a, b);
	return a + b;
})

[1, 2, 3, 4, 5].reduce(function (a, b) {
	return a + b;
}, 10);
// 25

var users = [{
		name: 'tom',
		email: 'tom@example.com'
	},
	{
		name: 'peter',
		email: 'peter@example.com'
	}
];

users
	.map(function (user) {
		return user.email;
	})
	.filter(function (email) {
		return /^t/.test(email);
	})
	.forEach(function (email) {
		console.log(email);
	});

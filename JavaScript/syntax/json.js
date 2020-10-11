var xiaoming = {
	name: "小明",
	age: 14,
	gender: true,
	height: 1.65,
	grade: null,
	"middle-school": '"W3C" Middle School',
	skills: ["JavaScript", "Java", "Python", "Lisp"],
};

JSON.stringify(xiaoming); // '{"name":"小明","age":14,"gender":true,"height":1.65,"grade":null,"middle-school":"\"W3C\" Middle School","skills":["JavaScript","Java","Python","Lisp"]}'
JSON.stringify(xiaoming, null, "  "); //输出得好看一些，可以加上参数，按缩进输出
JSON.stringify(xiaoming, ["name", "skills"], "  "); // 输出指定属性
function convert(key, value) {
	if (typeof value === "string") {
		return value.toUpperCase();
	}
	return value;
}
JSON.stringify(xiaoming, convert, "  ");

var xiaoming = {
	name: "小明",
	age: 14,
	gender: true,
	height: 1.65,
	grade: null,
	"middle-school": '"W3C" Middle School',
	skills: ["JavaScript", "Java", "Python", "Lisp"],
	toJSON: function () {
		return {
			// 只输出name和age，并且改变了key：
			Name: this.name,
			Age: this.age,
		};
	},
};

JSON.stringify(xiaoming); // '{"Name":"小明","Age":14}'

JSON.parse("[1,2,3,true]"); // [1, 2, 3, true]
JSON.parse('{"name":"小明","age":14}'); // Object {name: '小明', age: 14}
JSON.parse("true"); // true
JSON.parse("123.45"); // 123.45

JSON.parse('{"name":"小明","age":14}', function (key, value) {
	// 把number * 2:
	if (key === "name") {
		return value + "同学";
	}
	return value;
}); // Object {name: '小明同学', age: 14}

JSON.stringify('abc') // ""abc""
JSON.stringify(1) // "1"
JSON.stringify(false) // "false"
JSON.stringify([]) // "[]"
JSON.stringify({}) // "{}"

JSON.stringify([1, "false", false])
// '[1,"false",false]'

JSON.stringify({
	name: "张三"
})
// '{"name":"张三"}'

JSON.stringify('foo') === "foo" // false
JSON.stringify('foo') === "\"foo\"" // true
JSON.stringify(false) // "false"
JSON.stringify('false') // "\"false\""

var obj = {
	'prop1': 'value1',
	'prop2': 'value2',
	'prop3': 'value3'
};

var selectedProperties = ['prop1', 'prop2'];

JSON.stringify(obj, selectedProperties)
// "{"prop1":"value1","prop2":"value2"}"

function f(key, value) {
	if (typeof value === "number") {
		value = 2 * value;
	}
	return value;
}

JSON.stringify({
	a: 1,
	b: 2
}, f)
// '{"a": 2,"b": 4}'

var obj = {
	a: {
		b: 1
	}
};

function f(key, value) {
	console.log("[" + key + "]:" + value);
	return value;
}
JSON.stringify(obj, f)
// []:[object Object]
// [a]:[object Object]
// [b]:1
// '{"a":{"b":1}}'

var obj = {
	a: 1
};

function f(key, value) {
	if (typeof value === 'object') {
		return {
			b: 2
		};
	}
	return value * 2;
}

JSON.stringify(obj, f)
// "{"b": 4}"

// 分行输出
JSON.stringify({
	p1: 1,
	p2: 2
}, null, '\t')

var user = {
	firstName: '三',
	lastName: '张',

	get fullName() {
		return this.lastName + this.firstName;
	},

	toJSON: function () {
		return {
			name: this.lastName + this.firstName
		};
	}
};

JSON.stringify(user)
// "{"name":"张三"}"

var obj = {
	reg: /foo/
};

// 不设置 toJSON 方法时
JSON.stringify(obj) // "{"reg":{}}"

// 设置 toJSON 方法时
RegExp.prototype.toJSON = RegExp.prototype.toString;
JSON.stringify(/foo/) // ""/foo/""

JSON.parse('{}') // {}
JSON.parse('true') // true
JSON.parse('"foo"') // "foo"
JSON.parse('[1, 5, "false"]') // [1, 5, "false"]
JSON.parse('null') // null

var o = JSON.parse('{"name": "张三"}');
o.name // 张三

try {
	JSON.parse("'String'");
} catch (e) {
	console.log('parsing error');
}

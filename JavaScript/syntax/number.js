123; // 整数123
0.456; // 浮点数0.
var y = 0377;
var z = 0xff;
1.2345e3; // 科学计数法表示1.2345x1000，等同于1234.5
-
99; // 负数
NaN; // NaN表示Not a Number，当无法计算结果时用NaN表示
Infinity; // Infinity表示无限大，当数值超过了JavaScript的Number所能表示的最大值时，就表示为Infinity


// 精度
Math.pow(2, 53)
// 9007199254740992

Math.pow(2, 53) + 1
// 9007199254740992

Math.pow(2, 53) + 2
// 9007199254740994

Math.pow(2, 53) + 3
// 9007199254740996

Math.pow(2, 53) + 4
// 9007199254740996

// 范围
Math.pow(2, 1024) // Infinity

Math.pow(2, -1075) // 0
var x = 0.5;

for (var i = 0; i < 25; i++) {
	x = x * x;
}

x // 0


0.1 + 0.2 === 0.3
// false

0.3 / 0.1
// 2.9999999999999996

(0.3 - 0.2) === (0.2 - 0.1)
// false

1234567890123456789012
// 1.2345678901234568e+21

// 小数点后紧跟5个以上的零，
// 就自动转为科学计数法
0.0000003 // 3e-7

	(1 / +0) === (1 / -0) // false

5 - 'x' // NaN

Math.acos(2) // NaN
Math.log(-1) // NaN
Math.sqrt(-1) // NaN

0 / 0 // NaN

typeof NaN // 'number'
NaN === NaN // false
[NaN].indexOf(NaN) // -1
Boolean(NaN) // false
NaN + 32 // NaN
NaN - 32 // NaN
NaN * 32 // NaN
NaN / 32 // NaN


Math.pow(2, 1024)
// Infinity

// 场景二
0 / 0 // NaN
1 / 0 // Infinity

Infinity === -Infinity // false

1 / -0 // -Infinity
	-
	1 / -0 // Infinity

Infinity > NaN // false
	-
	Infinity > NaN // false

Infinity < NaN // false
	-
	Infinity < NaN // false

5 * Infinity // Infinity
5 - Infinity // -Infinity
Infinity / 5 // Infinity
5 / Infinity // 0

0 * Infinity // NaN
0 / Infinity // 0
Infinity / 0 // Infinity

Infinity + Infinity // Infinity
Infinity * Infinity // Infinity

Infinity - Infinity // NaN
Infinity / Infinity // NaN

null * Infinity // NaN
null / Infinity // 0
Infinity / null // Infinity

undefined + Infinity // NaN
undefined - Infinity // NaN
undefined * Infinity // NaN
undefined / Infinity // NaN
Infinity / undefined // NaN


parseInt('123') // 123
parseInt(1.23) // 1

parseInt('8a') // 8
parseInt('12**') // 12
parseInt('12.34') // 12
parseInt('15e2') // 15
parseInt('15px') // 15
parseInt(1000000000000000000000.5) // 1
parseInt('1000', 2) // 8
parseInt('1000', 6) // 216
parseInt('1000', 8) // 512

parseInt('10', 37) // NaN
parseInt('10', 1) // NaN
parseInt('10', 0) // 10
parseInt('10', null) // 10
parseInt('10', undefined) // 10

parseInt('1546', 2) // 1
parseInt('546', 2) // NaN

parseInt(0x11, 36) // 43
parseInt(0x11, 2) // 1

// 等同于
parseInt(String(0x11), 36)
parseInt(String(0x11), 2)

// 等同于
parseInt('17', 36)
parseInt('17', 2)
parseInt(011, 2) // NaN

// 等同于
parseInt(String(011), 2)

// 等同于
parseInt(String(9), 2)

parseFloat('3.14') // 3.14
parseFloat('314e-2') // 3.14
parseFloat('0.0314E+2') // 3.14
parseFloat('3.14more non-digit characters') // 3.14
parseFloat('\t\v\r12.34\n ') // 12.34
parseFloat([]) // NaN
parseFloat('FF2') // NaN
parseFloat('') // NaN
parseFloat(true) // NaN
Number(true) // 1

parseFloat(null) // NaN
Number(null) // 0

parseFloat('') // NaN
Number('') // 0

parseFloat('123.45#') // 123.45
Number('123.45#') // NaN

isNaN('Hello') // true
// 相当于
isNaN(Number('Hello')) // true
isNaN({}) // true
isNaN(['xzy']) // true
isNaN([]) // false
isNaN([123]) // false
isNaN(['123']) // false

function myIsNaN(value) {
	return typeof value === 'number' && isNaN(value);
}

function myIsNaN(value) {
	return value !== value;
}

isFinite(Infinity) // false
isFinite(-Infinity) // false
isFinite(NaN) // false
isFinite(undefined) // false
isFinite(null) // true
isFinite(-1) // true


// 数值：转换后还是原来的值
Number(324) // 324

// 字符串：如果可以被解析为数值，则转换为相应的数值
Number('324') // 324

// 字符串：如果不可以被解析为数值，返回 NaN
Number('324abc') // NaN

// 空字符串转为0
Number('') // 0

// 布尔值：true 转成 1，false 转成 0
Number(true) // 1
Number(false) // 0

// undefined：转成 NaN
Number(undefined) // NaN

// null：转成0
Number(null) // 0

// 类型转换
parseInt('\t\v\r12.34\n') // 12
Number('\t\v\r12.34\n') // 12.34
Number({
	a: 1
}) // NaN
Number([1, 2, 3]) // NaN
Number([5]) // 5
Number({}) // NaN
Number({
	valueOf: function () {
		return 2;
	},
	toString: function () {
		return 3;
	}
})
// 2

'5' - '2' // 3
'5' * '2' // 10
true - 1 // 0
false - 1 // -1
'1' - 1 // 0
	'5' * [] // 0
false / '5' // 0
'abc' - 1 // NaN
null + 1 // 1
undefined + 1 // NaN

Number.POSITIVE_INFINITY // Infinity
Number.NEGATIVE_INFINITY // -Infinity
Number.NaN // NaN

Number.MAX_VALUE
// 1.7976931348623157e+308
Number.MAX_VALUE < Infinity
// true

Number.MIN_VALUE
// 5e-324
Number.MIN_VALUE > 0
// true

Number.MAX_SAFE_INTEGER // 9007199254740991
Number.MIN_SAFE_INTEGER // -9007199254740991

(10).toString(2) // "1010"
(10).toString(8) // "12"
(10).toString(16) // "a"

(10).toFixed(2) // "10.00"
10.005.toFixed(2) // "10.01"

(10).toExponential() // "1e+1"
(10).toExponential(1) // "1.0e+1"
(10).toExponential(2) // "1.00e+1"

(1234).toExponential() // "1.234e+3"
(1234).toExponential(1) // "1.2e+3"
(1234).toExponential(2) // "1.23e+3"

(12.34).toPrecision(1) // "1e+1"
(12.34).toPrecision(2) // "12"
(12.34).toPrecision(3) // "12.3"
(12.34).toPrecision(4) // "12.34"
(12.34).toPrecision(5) // "12.340"

(123).toLocaleString('zh-Hans-CN-u-nu-hanidec')
	(123).toLocaleString('zh-Hans-CN', {
		style: 'percent'
	})

(123).toLocaleString('zh-Hans-CN', {
	style: 'currency',
	currency: 'CNY'
})
// "￥123.00"

(123).toLocaleString('de-DE', {
	style: 'currency',
	currency: 'EUR'
})
// "123,00 €"

(123).toLocaleString('en-US', {
	style: 'currency',
	currency: 'USD'
})
// "$123.00"

Number.prototype.iterate = function () {
	var result = [];
	for (var i = 0; i <= this; i++) {
		result.push(i);
	}
	return result;
};

(8).iterate()
// [0, 1, 2, 3, 4, 5, 6, 7, 8]

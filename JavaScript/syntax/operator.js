true + true // 2
1 + true // 2

'a' + 'bc' // "abc"

1 + 'a' // "1a"
false + 'a' // "falsea"

'3' + 4 + 5 // "345"
3 + 4 + '5' // "75"

1 - '2' // -1
1 * '2' // 2
1 / '2' // 0.5

var obj = {
	p: 1
};
obj + 2 // "[object Object]2"

var obj = new Date();
obj.valueOf = function () {
	return 1
};
obj.toString = function () {
	return 'hello'
};

obj + 2 // "hello2"


var x = 1;
var y = 1;

x++ // 1
++y // 2


	+
	true // 1
	+
	[] // 0
	+
	{} // NaN

var x = 1; -
x // -1
	-
	(-x) // 1

2 ** 4 // 16


'cat' > 'dog' // false
'cat' > 'catalog' // false
'cat' > 'Cat' // true'

var x = [2];
x > '11' // true

x.valueOf = function () {
	return '1'
};
x > '11' // false
// 等同于 [2].valueOf() > '11'
// 即 '1' > '11'

[2] > [1] // true
// 等同于 [2].valueOf().toString() > [1].valueOf().toString()
// 即 '2' > '1'

[2] > [11] // true
// 等同于 [2].valueOf().toString() > [11].valueOf().toString()
// 即 '2' > '11'

{
	x: 2
} >= {
	x: 1
} // true
// 等同于 { x: 2 }.valueOf().toString() >= { x: 1 }.valueOf().toString()
// 即 '[object Object]' >= '[object Object]'

1 === 0x1 // true

NaN === NaN // false
	+
	0 === -0 // true

{} === {} // false
[] === [] // false
(function () {} === function () {}) // false

undefined === undefined // true
null === null // true

1 !== '1' // true
	// 等同于
	!(1 === '1')

1 == true // true
// 等同于 1 === Number(true)

0 == false // true
// 等同于 0 === Number(false)

2 == true // false
// 等同于 2 === Number(true)

2 == false // false
// 等同于 2 === Number(false)

'true' == true // false
	// 等同于 Number('true') === Number(true)
	// 等同于 NaN === 1

	'' == 0 // true
// 等同于 Number('') === 0
// 等同于 0 === 0

'' == false // true
	// 等同于 Number('') === Number(false)
	// 等同于 0 === 0

	'1' == true // true
// 等同于 Number('1') === Number(true)
// 等同于 1 === 1

'\n  123  \t' == 123 // true
	// 因为字符串转为数字时，省略前置和后置的空格

	// 数组与数值的比较
	[1] == 1 // true

// 数组与字符串的比较
[1] == '1' // true
[1, 2] == '1,2' // true

// 对象与布尔值的比较
[1] == true // true
	[2] == true // false

const obj = {
	valueOf: function () {
		console.log('执行 valueOf()');
		return obj;
	},
	toString: function () {
		console.log('执行 toString()');
		return 'foo';
	}
};

obj == 'foo'
// 执行 valueOf()
// 执行 toString()
// true

// 相等运算符的缺点
0 == '' // true
0 == '0' // true

2 == true // false
2 == false // false

false == 'false' // false
false == '0' // true

false == undefined // false
false == null // false
null == undefined // true

// 找到第一个false
' \t\r\n ' == 0 // true
	't' && '' // ""
't' && 'f' // "f"
't' && (1 + 2) // 3
'' && 'f' // ""
'' && '' // ""

var x = 1;
(1 - 1) && (x += 1) // 0
x // 1

// 短路用法
if (i) {
	doSomething();
}
// 等价于
i && doSomething();

true && 'foo' && '' && 4 && 'foo' && true
// ''

1 && 2 && 3
// 3

// 找到第一个true
't' || '' // "t"
't' || 'f' // "t"
'' || 'f' // "f"
'' || '' // ""

false || 0 || '' || 4 || 'foo' || true
// 4

false || 0 || ''
// ''

i = i | 0;
// 将任意数值转为32位整数
function toInt32(x) {
	return x | 0;
}
toInt32(1.001) // 1
toInt32(1.999) // 1
toInt32(1) // 1
toInt32(-1) // -1
toInt32(Math.pow(2, 32) + 1) // 1
toInt32(Math.pow(2, 32) - 1) // -1

2.9 | 0 // 2
-2.9 | 0 // -2

~ 3 // -4

//  互换运算
var a = 10;
var b = 99;

a ^= b, b ^= a, a ^= b;

a // 99
b // 10

4 << 1
// 8

-4 << 1
// -8

var color = {r: 186, g: 218, b: 85};

// RGB to HEX
// (1 << 24)的作用为保证结果是6位数
var rgb2hex = function(r, g, b) {
  return '#' + ((1 << 24) + (r << 16) + (g << 8) + b)
    .toString(16) // 先转成十六进制，然后返回字符串
    .substr(1);   // 去除字符串的最高位，返回后面六个字符串
}

rgb2hex(color.r, color.g, color.b)
// "#bada55"

-1 >>> 0 // 4294967295


var x = 0;
var y = (x++, 10);

// 优先级
var y = ((arr.length <= 0) || (arr[0] === undefined)) ? x : arr[0];

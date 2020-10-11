`这是一个
多行
字符串`;

var longString = 'Long \
long \
long \
string';

var name = "小明";
var age = 20;
var message = "你好, " + name + ", 你今年" + age + "岁了!";
var message = `你好, ${name}, 你今年${age}岁了!`;

'key = "value"'
"It's a long journey"
'Did she say \'Hello\'?'
"Did she say \"Hello\"?"

(function () {
	/*
	line 1
	line 2
	line 3
	*/
}).toString().split('\n').slice(1, -1).join('\n')
// "line 1
// line 2
// line 3"

'\251' // "©"
'\xA9' // "©"
'\u00A9' // "©"

'\172' === 'z' // true
'\x7A' === 'z' // true
'\u007A' === 'z' // true

var s = '\u00A9';

var f\u006F\u006F = 'abc';
foo // "abc"


typeof new String("John"); // 返回 Object

var s = "Hello, world!";
s.length; // 13

s[0]; // 'H'
s[12]; // '!'
s[13]; // undefined 超出范围的索引不会报错，返回undefined

s[0] = "X";
alert(s); // s仍然为'Test'

delete s[0];
s // "hello"


var string = 'Hello World!';
btoa(string) // "SGVsbG8gV29ybGQh"
atob('SGVsbG8gV29ybGQh') // "Hello World!"

btoa('你好') // 报错

function b64Encode(str) {
	return btoa(encodeURIComponent(str));
}

function b64Decode(str) {
	return decodeURIComponent(atob(str));
}

b64Encode('你好') // "JUU0JUJEJUEwJUU1JUE1JUJE"
b64Decode('JUU0JUJEJUEwJUU1JUE1JUJE') // "你好"

s.toUpperCase();
s.toLowerCase();
s.indexOf("world"); // 指定字符串出现的第一个字符位置 返回7
s.indexOf("World"); // 没有找到指定的子串，返回-1
s.replace();
s.search();
s.match();

s.substring(0, 5); // 从索引0开始到5（不包括5），返回'hello'
s.substring(7); // 从索引7开始到结束，返回'world'

var str = "HELLO WORLD";
str.charAt(str.length - 1);

String(123) // "123"
String('abc') // "abc"
String(true) // "true"
String(undefined) // "undefined"
String(null) // "null"

String({
	a: 1
}) // "[object Object]"
String([1, 2, 3]) // "1,2,3"

'5' + 1 // '51'
	'5' + true // "5true"
'5' + false // "5false"
	'5' + {} // "5[object Object]"
'5' + [] // "5"
'5' + function () {} // "5function (){}"
'5' + undefined // "5undefined"
	'5' + null // "5null"

var s1 = 'abc';
var s2 = new String('abc');

typeof s1 // "string"
typeof s2 // "object"

s2.valueOf() // "abc"
(new String('abc'))[1] // "b"

String.fromCharCode() // ""
String.fromCharCode(97) // "a"
String.fromCharCode(104, 101, 108, 108, 111)
// "hello"

String.fromCharCode(0xD842, 0xDFB7)
// "𠮷"

'JavaScript'.slice(4) // "Script"

'JavaScript'.slice(-6) // "Script"
'JavaScript'.slice(0, -6) // "Java"
'JavaScript'.slice(-2, -1) // "p"
'JavaScript'.slice(2, 1) // ""

'JavaScript'.substr(-6) // "Script"
'JavaScript'.substr(4, -1) // ""

'hello world'.indexOf('o', 6) // 7

// match
var matches = 'cat, bat, sat, fat'.match('at');
matches.index // 1
matches.input // "cat, bat, sat, fat"

var s = '_x_x';
var r1 = /x/;
var r2 = /y/;

s.match(r1) // ["x"]
s.match(r2) // null

var s = 'abba';
var r = /a/g;

s.match(r) // ["a", "a"]
r.exec(s) // ["a"]

var r = /a|b/g;
r.lastIndex = 7;
'xaxb'.match(r) // ['a', 'b']
r.lastIndex // 0

'_x_x'.search(/x/)

'aaa'.replace('a', 'b') // "baa"
'aaa'.replace(/a/, 'b') // "baa"
'aaa'.replace(/a/g, 'b') // "bbb"

var str = '  #id div.class  ';
str.replace(/^\s+|\s+$/g, '') // "#id div.class"

'hello world'.replace(/(\w+)\s(\w+)/, '$2 $1')
// "world hello"
'abc'.replace('b', '[$`-$&-$\']')
// "a[a-b-c]c"

'3 and 5'.replace(/[0-9]+/g, function (match) {
	return 2 * match;
})
// "6 and 10"

var a = 'The quick brown fox jumped over the lazy dog.';
var pattern = /quick|brown|lazy/ig;

a.replace(pattern, function replacer(match) {
	return match.toUpperCase();
});
// The QUICK BROWN fox jumped over the LAZY dog.

var prices = {
	'p1': '$1.99',
	'p2': '$9.99',
	'p3': '$5.00'
};

var template = '<span id="p1"></span>' +
	'<span id="p2"></span>' +
	'<span id="p3"></span>';

template.replace(
	/(<span id=")(.*?)(">)(<\/span>)/g,
	function (match, $1, $2, $3, $4) {
		return $1 + $2 + $3 + prices[$2] + $4;
	}
);
// "<span id="p1">$1.99</span><span id="p2">$9.99</span><span id="p3">$5.00</span>"

// 非正则分隔
'a,  b,c, d'.split(',')
// [ 'a', '  b', 'c', ' d' ]

// 正则分隔，去除多余的空格
'a,  b,c, d'.split(/, */)
// [ 'a', 'b', 'c', 'd' ]

// 指定返回数组的最大成员
'a,  b,c, d'.split(/, */, 2) // ['a', 'b']
'a|b|c'.split('|') // ["a", "b", "c"]
'a|b|c'.split('') // ["a", "|", "b", "|", "c"]

'aaa**a*'.split(/a*/)
// ["", "*", "*", "*"]
'aaa*a*'.split(/(a*)/)
// [ '', 'aaa', '*', 'a', '*' ]

'apple'.localeCompare('banana') // -1
'apple'.localeCompare('apple') // 0

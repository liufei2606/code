"00\d"; //可以匹配'007'，但无法匹配'00A'；
"\d\d\d"; //可以匹配'010'；
"\w\w"; // 可以匹配'js'；
"js." // 可以匹配'jsp'、'jss'、'js!'
`\d{3}` //表示匹配3个数字，例如'010'；
`\s` // 可以匹配一个空格（也包括Tab等空白符），所以\s+表示至少有一个空格，例如匹配' '，'\t\t'等；
`\d{3,8}` // 表示3-8个数字，例如'1234567'。
`[0-9a-zA-Z\_]` // 可以匹配一个数字、字母或者下划线；
`[0-9a-zA-Z\_]+` // 可以匹配至少由一个数字、字母或者下划线组成的字符串，比如'a100'，'0_Z'，'js2015'等等；
`[a-zA-Z\_\$][0-9a-zA-Z\_\$]*` // 可以匹配由字母或下划线、$开头，后接任意个由一个数字、字母或者下划线、$组成的字符串，也就是JavaScript允许的变量名；
`[a-zA-Z\_\$][0-9a-zA-Z\_\$]{0, 19}` // 更精确地限制了变量的长度是1-20个字符（前面1个字符+后面最多19个字符）。
`(J|j)ava(S|s)cript` // 可以匹配'JavaScript'、'Javascript'、'javaScript'或者'javascript'。
`^js$`; // 就变成了整行匹配，就只能匹配'js'了

var re = /^\d{3}\-\d{3,8}$/;
var re = new RegExp("/^d{3}-d{3,8}$/");
var pattern = new RegExp("s$");

re.test("010-12345"); // 检索字符串中的指定值 true
re.test("010-1234x"); // false
re.test("010 12345"); // false

/cat/.test('cats and dogs') // true

"a b   c".split(/\s+/); // ['a', 'b', 'c']
"a,b, c  d".split(/[\s\,]+/); // ['a', 'b', 'c', 'd'
"a,b;; c  d".split(/[\s\,\;]+/); // ['a', 'b', 'c', 'd']

var re = /^(\d{3})-(\d{3,8})$/; // 检索字符串中的指定值。返回值是被找到的值
re.exec("010-12345"); // ['010-12345', '010', '12345']
re.exec("010 12345"); // null

var re = /^(0[0-9]|1[0-9]|2[0-3]|[0-9])\:(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|[0-9])\:(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|[0-9])$/; // 首部的0是做什么用的
re.exec("19:05:30"); // ['19:05:30', '19', '05', '30']

var re = /^(\d+)(0*)$/;
re.exec("102300"); // ['102300', '102300', '']

var re = /^(\d+?)(0*)$/;
re.exec("102300"); // ['102300', '1023', '00']

var s = "JavaScript, VBScript, JScript and ECMAScript";
var re = /[a-zA-Z]+Script/g;

// 使用全局匹配:
re.exec(s); // ['JavaScript']
re.lastIndex; // 10
re.exec(s); // ['VBScript']
re.lastIndex; // 20
re.exec(s); // ['JScript']
re.lastIndex; // 29
re.exec(s); // ['ECMAScript']
re.lastIndex; // 44
re.exec(s); // null，直到结束仍没有匹配到

var r = /abc/igm;

r.ignoreCase // true
r.global // true
r.multiline // true
r.flags // 'gim'

var r = /x/g;
var s = '_x_x';

r.lastIndex // 0
r.test(s) // true

r.lastIndex // 2
r.test(s) // true

r.lastIndex // 4
r.test(s) // false

var r = /x/g;
var s = '_x_x';

r.lastIndex = 4;
r.test(s) // false

r.lastIndex // 0
r.test(s)

new RegExp('').test('abc')
// true

// 每次匹配条件都是一个新的正则表达式，导致lastIndex属性总是等于0
// var count = 0;
// while (/a/g.test('babaa')) count++;

var s = '_x_x';
var r1 = /x/;
var r2 = /y/;

r1.exec(s) // ["x"]
r2.exec(s) // null

var r = /a(b+)a/;
var arr = r.exec('_abbba_aba_');

arr // ["abbba", "bbb"]

arr.index // 1
arr.input // "_abbba_aba_"

var reg = /a/g;
var str = 'abc_abc_abc'

while (true) {
	var match = reg.exec(str);
	if (!match) break;
	console.log('#' + match.index + ':' + match[0]);
}
// #0:a
// #4:a
// #8:a

// test必须出现在开始位置
/^test/.test('test123') // true

	// test必须出现在结束位置
	/
	test$ / .test('new test') // true

	// 从开始位置到结束位置只有test
	/
	^
	test$ / .test('test') // true
	/
	^
	test$ / .test('test test') // false
(new RegExp('1\\+1')).test('1+1')
	// true

	// \s 的例子
	/
	\s\ w * /.exec('hello world') / / [" world"]

	// \b 的例子
	/
	\bworld / .test('hello world') // true
	/
	\bworld / .test('hello-world') // true
	/
	\bworld / .test('helloworld') // false

	// \B 的例子
	/
	\Bworld / .test('hello-world') // false
	/
	\Bworld / .test('helloworld') // true

// 遇到换行符（\n）就会停止匹配
var html = "<b>Hello</b>\n<i>world!</i>";

/.*/.exec(html)[0]
	// "<b>Hello</b>"

	/
	[\S\ s] * /.exec(html)[0]
	// "<b>Hello</b>\n<i>world!</i>"

	/
	lo {
		2
	}
k / .test('look') // true
	/
	lo {
		2,
		5
	}
k / .test('looook') // true

	// t 出现0次或1次
	/
	t ? est / .test('test') // true
	/
	t ? est / .test('est') // true

	// t 出现1次或多次
	/
	t + est / .test('test') // true
	/
	t + est / .test('ttest') // true
	/
	t + est / .test('est') // false

	// t 出现0次或多次
	/
	t * est / .test('test') // true
	/
	t * est / .test('ttest') // true
	/
	t * est / .test('tttest') // true
	/
	t * est / .test('est') // true

var s = 'aaa';
s.match(/a+?/) // ["a"]

var regex = /b/g;
var str = 'abba';

regex.test(str); // true
regex.test(str); // true
regex.test(str); // false

/world$/.test('hello world\n') // false
	/
	world$ / m.test('hello world\n') // true
	/
	^ b / m.test('a\nb') // true

	/
	(fred) + /.test('fredfred') / / true
var m = 'abcabc'.match(/(.)b(.)/);
m
// ['abc', 'a', 'c']

// 组匹配时，不宜同时使用g修饰符，否则match方法不会捕获分组的内容
var m = 'abcabc'.match(/(.)b(.)/g);
m // ['abc', 'abc']

var str = 'abcabc';
var reg = /(.)b(.)/g;
while (true) {
	var result = reg.exec(str);
	if (!result) break;
	console.log(result);
}
// ["abc", "a", "c"]
// ["abc", "a", "c"]

/(.)b(.)\1b\2/.test("abcabc")
	// true
	/
	y((..)\ 2)\ 1 / .test('yabababab') // true

var tagName = /<([^>]+)>[^<]*<\/\1>/;
tagName.exec("<b>bold</b>")[1]
// 'b'

var html = '<b class="hello">Hello</b><i>world</i>';
var tag = /<(\w+)([^>]*)>(.*?)<\/\1>/g;

var match = tag.exec(html);

match[1] // "b"
match[2] // " class="hello""
match[3] // "Hello"

match = tag.exec(html);

match[1] // "i"
match[2] // ""
match[3] // "world"

var m = 'abc'.match(/(?:.)b(.)/);
m // ["abc", "c"]

// 正常匹配
var url = /(http|ftp):\/\/([^/\r\n]+)(\/[^\r\n]*)?/;

url.exec('http://google.com/');
// ["http://google.com/", "http", "google.com", "/"]

// 非捕获组匹配
var url = /(?:http|ftp):\/\/([^/\r\n]+)(\/[^\r\n]*)?/;

url.exec('http://google.com/');
// ["http://google.com/", "google.com", "/"]

var m = 'abc'.match(/b(?=c)/);
m // ["b"]

/\d+(?!\.)/.exec('3.14')
// ["14"]

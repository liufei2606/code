// 方法一：传入字符串
var params = new URLSearchParams('?foo=1&bar=2');
// 等同于
var params = new URLSearchParams(document.location.search);

// 方法二：传入数组
var params = new URLSearchParams([
	['foo', 1],
	['bar', 2]
]);

// 方法三：传入对象
var params = new URLSearchParams({
	'foo': 1,
	'bar': 2
});

var params = new URLSearchParams({
	'foo': '你好'
});
params.toString() // "foo=%E4%BD%A0%E5%A5%BD"

const params = new URLSearchParams({
	foo: 1,
	bar: 2
});
fetch('https://example.com/api', {
	method: 'POST',
	body: params
}).then()


var params = new URLSearchParams('a=1&b=2');

for (var p of params.keys()) {
	console.log(p);
}
// a
// b

for (var p of params.values()) {
	console.log(p);
}
// 1
// 2

for (var p of params.entries()) {
	console.log(p);
}
// ["a", "1"]
// ["b", "2"]

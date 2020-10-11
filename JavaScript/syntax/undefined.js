function f(x) {
	return x;
}
f() // undefined

Number(undefined) // NaN
5 + undefined // NaN

if (!undefined) {
	console.log('undefined is false');
}
// undefined is false

// 变量声明了，但没有赋值
var i;
i // undefined

// 调用函数时，应该提供的参数没有提供，该参数等于 undefined
function f(x) {
	return x;
}
f() // undefined

// 对象没有赋值的属性
var o = new Object();
o.p // undefined

// 函数没有返回值时，默认返回 undefined
function f() {}
f() // undefined

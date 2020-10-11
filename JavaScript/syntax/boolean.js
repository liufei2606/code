true; // 这是一个true值
false; // 这是一个false值

// 构造函数
var myBoolean = new Boolean(); // 创建初始值为 false 的 Boolean 对象
var myBoolean = new Boolean(false);

// 转化
Boolean(undefined) // false
Boolean(null) // false
Boolean(0) // false
Boolean(NaN) // false
Boolean('') // false

Boolean({}) // true
Boolean([]) // true
Boolean(new Boolean(false)) // true

	!!undefined // false
	!!null // false
	!!0 // false
	!!'' // false
	!!NaN // false

	!!1 // true
	!!'false' // true
	!![] // true
	!!{} // true
	!! function () {} // true
	!!/foo/ // true


if (Boolean(false)) {
	console.log('true');
} // 无输出

if (new Boolean(false)) {
	console.log('true');
} // true

if (Boolean(null)) {
	console.log('true');
} // 无输出

if (new Boolean(null)) {
	console.log('true');
} // true

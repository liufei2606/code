// 静态属性
Math.E // 2.718281828459045
Math.LN2 // 2 的自然对数 0.6931471805599453
Math.LN10 // 2.302585092994046
Math.LOG2E // 1.4426950408889634
Math.LOG10E // 0.4342944819032518
Math.PI // 3.141592653589793
Math.SQRT1_2 // 1/2 的平方根 0.7071067811865476
Math.SQRT2 //  2 的平方根 1.4142135623730951

// 静态方法
function ToInteger(x) {
	x = Number(x);
	return x < 0 ? Math.ceil(x) : Math.floor(x);
}

ToInteger(3.2) // 3
ToInteger(3.5) // 3
ToInteger(3.8) // 3
ToInteger(-3.2) // -3
ToInteger(-3.5) // -3
ToInteger(-3.8) // -3

Math.round(0.6); // 四舍五入
Math.random(); //返回 0 到 1 之间的随机数
Math.floor(Math.random() * 11); // 返回一个介于 0 和 10 之间的随机数
Math.ceil(Math.random() * 11); // 返回一个介于 1 和 11 之间的随机数
Math.max(7.25, 7.3);
Math.min(7.25, 7.3);
Math.pow(2, 3) // 8

Math.sqrt(4) // 2

Math.log(Math.E) // 1
Math.log(10) // 2.302585092994046

Math.exp(1) // 2.718281828459045
Math.exp(3) // 20.085536923187668
Math.random() // 0.7151307314634323

function getRandomArbitrary(min, max) {
	return Math.random() * (max - min) + min;
}

getRandomArbitrary(1.5, 6.5)
// 2.4942810038223864

// 返回随机字符
function random_str(length) {
	var ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	ALPHABET += 'abcdefghijklmnopqrstuvwxyz';
	ALPHABET += '0123456789-_';
	var str = '';
	for (var i = 0; i < length; ++i) {
		var rand = Math.floor(Math.random() * ALPHABET.length);
		str += ALPHABET.substring(rand, rand + 1);
	}
	return str;
}

random_str(6) // "NdQKOr"

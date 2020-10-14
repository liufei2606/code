console.log(1);
setTimeout('console.log(2)', 1000);
console.log(3);

function f() {
	console.log(2);
}

setTimeout(f, 1000);

setTimeout(function (a, b) {
	console.log(a + b);
}, 1000, 3, 4);

// 回调函数是对象的方法，那么setTimeout使得方法内部的this关键字指向全局环境，而不是定义时所在的那个对象
var x = 1;

var obj = {
	x: 2,
	y: function () {
		console.log(this.x);
	}
};

setTimeout(function () {
	obj.y();
}, 1000);
// 2

var x = 1;

var obj = {
	x: 2,
	y: function () {
		console.log(this.x);
	}
};

setTimeout(obj.y.bind(obj), 1000)

var div = document.getElementById('someDiv');
var opacity = 1;
var fader = setInterval(function () {
	opacity -= 0.1;
	if (opacity >= 0) {
		div.style.opacity = opacity;
	} else {
		clearInterval(fader);
	}
}, 100);

// 确保两次执行之间有固定的间隔
var i = 1;
var timer = setTimeout(function f() {
	// ...
	timer = setTimeout(f, 2000);
}, 2000);

// 取消当前所有的setTimeout定时器
(function () {
	// 每轮事件循环检查一次
	var gid = setInterval(clearAllTimeouts, 0);

	function clearAllTimeouts() {
		var id = setTimeout(function () {}, 0);
		while (id > 0) {
			if (id !== gid) {
				clearTimeout(id);
			}
			id--;
		}
	}
})();

// debounce
$('textarea').on('keydown', debounce(ajaxAction, 2500));

function debounce(fn, delay) {
	var timer = null; // 声明计时器
	return function () {
		var context = this;
		var args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			fn.apply(context, args);
		}, delay);
	};
}

setInterval(function () {
	console.log(2);
}, 1000);

sleep(3000);

function sleep(ms) {
	var start = Date.now();
	while ((Date.now() - start) < ms) {}
}

// 执行 A-》C->B
var input = document.getElementById('myButton');

input.onclick = function A() {
	setTimeout(function B() {
		input.value += ' input';
	}, 0)
};

document.body.onclick = function C() {
	input.value += ' body'
};

//
document.getElementById('input-box').onkeypress = function () {
	var self = this;
	setTimeout(function () {
		self.value = self.value.toUpperCase();
	}, 0);
}

// 调整任务顺序
var div = document.getElementsByTagName('div')[0];

// 写法一
for (var i = 0xA00000; i < 0xFFFFFF; i++) {
	div.style.backgroundColor = '#' + i.toString(16);
}

// 写法二
var timer;
var i = 0x100000;

function func() {
	timer = setTimeout(func, 0);
	div.style.backgroundColor = '#' + i.toString(16);
	if (i++ == 0xFFFFFF) clearTimeout(timer);
}

timer = setTimeout(func, 0);

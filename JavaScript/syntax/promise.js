var promise = new Promise(function (resolve, reject) {
	// ...

	if ( /* 异步操作成功 */ true) {
		resolve(value);
	} else {
		/* 异步操作失败 */
		reject(new Error());
	}
});

var p1 = new Promise(function (resolve, reject) {
	resolve('成功');
});
p1.then(console.log, console.error);
// "成功"

var p2 = new Promise(function (resolve, reject) {
	reject(new Error('失败'));
});
p2.then(console.log, console.error);
// Error: 失败

var preloadImage = function (path) {
	return new Promise(function (resolve, reject) {
		var image = new Image();
		image.onload = resolve;
		image.onerror = reject;
		image.src = path;
	});
};
preloadImage('https://example.com/my.jpg')
	.then(function (e) {
		document.body.append(e.target)
	})
	.then(function () {
		console.log('加载成功')
	})

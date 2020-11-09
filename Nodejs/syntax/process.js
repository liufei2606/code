global.console

console.log(process === global.process);
console.log(process.version + ' ' + process.platform + ' ' + process.arch + ' ' + process.cmd);

process.chdir('/private/tmp'); // 切换当前工作目录

process.nextTick(function () {
	console.log('nextTick callback!');
});
console.log('nextTick was set!');

// 程序即将退出时的回调函数:
process.on('exit', function (code) {

	etTimeout(function () {
		console.log("该代码不会执行");
	}, 0);
	console.log('about to exit with code: ' + code);
});

const [, , ...args] = process.argv;
console.log(args[0]);


// API_URL=http://example.com/api node ./index.js # 通过process.env.API_URL取得传入的API地址

process.stdout.write("Hello World!" + "\n");
process.argv.forEach(function (val, index, array) {
	console.log(index + ': ' + val);
});
console.log(process.execPath);
console.log(process.platform);


console.log('当前目录: ' + process.cwd());
console.log('当前版本: ' + process.version);
console.log(process.memoryUsage());

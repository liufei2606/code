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
	console.log('about to exit with code: ' + code);
});

const [, , ...args] = process.argv;
console.log(args[0]);

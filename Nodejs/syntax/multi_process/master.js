var fork = require('child_process').fork;
var cpus = require('os').cpus();
var server = require('net').createServer()
server.listen(1337);

var workers = []
server.on('connection', function (socket) {
	var one_worker = workers.pop();//取出一个worker
	one_worker.send('server', socket);
	workers.unshift(one_worker);//再放回取出的worker
})

for (var i = 0; i < cpus.length; i++) {
	var worker = fork('worker.js');


	worker.send('server', server);
}


var other_work = {};


var limit = 10;
//时间单位
var during = 60000;
var restart = [];
var isTooFrequently = function () {
	//纪录重启时间
	var time = Date.now()
	var length = restart.push(time);
	if (length > limit) {
		//取出最后10个纪录
		restart = restart.slice(limit * -1)
	}
	return restart.length >= limit && restart[restart.length - 1] - restart[0] < during;
}

// 检查是否太过频繁
if (isTooFrequently()) {
	//触发giveup事件后，不再重启
	process.emit('giveup', length, duiring);
	return;
}

var createWorker = function () {
	var worker = fork('./worker.js')
	worker.on('message', function () {
		if (message.act === 'suicide') {
			createWorker();
		}
	})
	worker.on('exit', function () {
		console.log('worker ' + worker.pid + ' exited.');
		delete other_work[worker.pid]
	});

	worker.on('disconnect', function () {
		worker.kill();
		console.log('worker' + worker.pid + 'killed')
		createWorker();
	})
	other_work[worker.pid] = worker;
	console.log('create worker pid: ' + worker.pid)
}


const fs = require('fs');
const child_process = require('child_process');

for (var i = 0; i < 3; i++) {
	var workerProcess = child_process.exec('node support.js ' + i, function (error, stdout, stderr) {
		if (error) {
			console.log(error.stack);
			console.log('Error code: ' + error.code);
			console.log('Signal received: ' + error.signal);
		}
		console.log('stdout: ' + stdout);
		console.log('stderr: ' + stderr);
	});

	workerProcess.on('exit', function (code) {
		console.log('子进程已退出，退出码 ' + code);
	});
}



for (var i = 0; i < 3; i++) {
	var workerProcess = child_process.spawn('node', ['support.js', i]);

	workerProcess.stdout.on('data', function (data) {
		console.log('stdout: ' + data);
	});

	workerProcess.stderr.on('data', function (data) {
		console.log('stderr: ' + data);
	});

	workerProcess.on('close', function (code) {
		console.log('子进程已退出，退出码 ' + code);
	});
}

for (var i = 0; i < 3; i++) {
	var worker_process = child_process.fork("support.js", [i]);

	worker_process.on('close', function (code) {
		console.log('子进程已退出，退出码 ' + code);
	});
}

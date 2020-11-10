const http = require('http');

var server = http.createServer(function (req, res) {
	res.writeHead(200, { 'Content-Type': 'text/plain' });
	res.end('handled by child, pid is ' + process.pid + '\n')
})

process.on('message', function (m, tcp) {
	if (m === 'server') {
		tcp.on('connection', function (socket) {
			server.emit('connection', socket);
		});
	}
});

process.on('uncaughtException', function (err) {
	console.error(err);
	process.send({ act: 'suicide' })
	worker.close(function () {
		process.exit(1)
	})
	//如果存在长连接，断开可能需要较久的时间，要强制退出，
	setTimeout(function () {
		process.exit(1)
	}, 5000);
})


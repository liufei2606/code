const fs = require('fs');

// 文件读取
fs.readFile('sample.txt', 'utf-8', function (err, data) {
	if (err) {
		console.log(err);
	} else {
		console.log(data);
	}
});

// 同步读文件
try {
	var data = fs.readFileSync('sample.txt', 'utf-8');
	console.log(data);
} catch (err) {
	// 出错了
}


const data = 'Hello, Node.js';
fs.writeFile('output.txt', data, function (err) {
	if (err) {
		console.log(err);
	} else {
		console.log('ok.');
	}
});
fs.writeFileSync('output.txt', data);

// 文件状态
fs.stat('sample.txt', function (err, stat) {
	if (err) {
		console.log(err);
	} else {
		// 是否是文件:
		console.log('isFile: ' + stat.isFile());
		// 是否是目录:
		console.log('isDirectory: ' + stat.isDirectory());
		if (stat.isFile()) {
			// 文件大小:
			console.log('size: ' + stat.size);
			// 创建时间, Date对象:
			console.log('birth time: ' + stat.birthtime);
			// 修改时间, Date对象:
			console.log('modified time: ' + stat.mtime);
		}
	}
});

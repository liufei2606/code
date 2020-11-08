
const fs = require('fs');

const inputFilePath = './input.txt';
const readStream = fs.createReadStream(
	inputFilePath,
	{ encoding: 'utf8', highWaterMark: 1024 }
);

readStream.on('data', (chunk) => {
	console.log('>>> ' + chunk);
});
readStream.on('end', () => {
	console.log('### DONE ###');
});

async function main(inputFilePath) {
	const readStream = fs.createReadStream(inputFilePath,
		{ encoding: 'utf8', highWaterMark: 1024 });

	for await (const chunk of readStream) {
		console.log('>>> ' + chunk);
	}
	console.log('### DONE ###');
}


var fs = require('fs');  // 异步读文件
fs.readFile('sample.txt', 'utf-8', function (err, data) {
    if (err) {
        console.log(err);
    } else {
        console.log(data);
    }
});

// 同步读文件
var data = fs.readFileSync('sample.txt', 'utf-8');
console.log(data);

try {
    var data = fs.readFileSync('sample.txt', 'utf-8');
    console.log(data);
} catch (err) {
    // 出错了
}

var data = 'Hello, Node.js';
fs.writeFile('output.txt', data, function (err) {
    if (err) {
        console.log(err);
    } else {
        console.log('ok.');
    }
});
fs.writeFileSync('output.txt', data);

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

// 读取流:
var rs = fs.createReadStream('sample.txt', 'utf-8');
rs.on('data', function (chunk) {
    console.log('DATA:')
    console.log(chunk);
});
rs.on('end', function () {
    console.log('END');
});
rs.on('error', function (err) {
    console.log('ERROR: ' + err);
});

// 写入流
var ws1 = fs.createWriteStream('output1.txt', 'utf-8');
ws1.write('使用Stream写入文本数据...\n');
ws1.write('END.');
ws1.end();

var ws2 = fs.createWriteStream('output2.txt');
ws2.write(new Buffer('使用Stream写入二进制数据...\n', 'utf-8'));
ws2.write(new Buffer('END.', 'utf-8'));
ws2.end();

// pipe
var rs = fs.createReadStream('sample.txt');
var ws = fs.createWriteStream('copied.txt');
readable.pipe(writable, { end: false });
rs.pipe(ws);

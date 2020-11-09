const fs = require('fs');

const data = '';
const inputFilePath = './input.txt';
const readStream = fs.createReadStream(
	inputFilePath,
	{ encoding: 'utf8', highWaterMark: 1024 }
);

readStream.on('data', (chunk) => {
	data += chunk;
	console.log('>>> ' + chunk);
});

console.log('管道流执行完毕');
readStream.on('end', () => {
	console.log('### DONE ###');
	console.log(data);
});

readStream.on('error', function (err) {
	console.log('ERROR: ' + err.stack);
});

console.log('读入数据完毕');

async function main(inputFilePath) {
	const readStream = fs.createReadStream(inputFilePath,
		{ encoding: 'utf8', highWaterMark: 1024 });

	for await (const chunk of readStream) {
		console.log('>>> ' + chunk);
	}
	console.log('### DONE ###');
}


// stream写入文件
var writerStream = fs.createWriteStream('output.txt');
var data1 = "新写入内容1";
writerStream.write(data1, 'UTF8');
writerStream.end();
writerStream.on('finish', function () {
	console.log('写入数据成功');
})
writerStream.on('error', function () {
	console.log('err.stack');
});
console.log('写入程序完毕');

//二进制友好，图片操作
const rs = fs.createReadStream('./img.png')
const ws = fs.createWriteStream('./img2.png')
readable.pipe(writable, { end: false });
// rs.pipe(ws);

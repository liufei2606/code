var fs = require('fs');

// stream写入文件
var writerStream = fs.createWriteStream('output.txt');
var data = "新写入内容1";
writerStream.write(data, 'UTF8');
writerStream.end();
writerStream.on('finish', function(){
  console.log('写入数据成功');
})
writerStream.on('error', function(){
  console.log('err.stack');
});
console.log('写入程序完毕');

// 读取流文件
var data = '';
var readerStream = fs.createReadStream('input.txt');
readerStream.setEncoding('utf8');

readerStream.on('data', function(chunk) {
  data += chunk;
});

console.log('管道流执行完毕');

readerStream.on('end', function() {
  console.log(data);
});

readerStream.on('error', function(err) {
  console.log(err.stack);
});
console.log('读入数据完毕');

//  管道流
readerStream.pipe(writerStream);

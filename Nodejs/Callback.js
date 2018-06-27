/*block sample*/
var fs = require('fs');
var data = fs.readFileSync('input.txt');
console.log(data.toString());
console.log('代码执行结束1');

/*unblock sample*/
fs.readFile('input.txt', function(err, data) {
    if (err) {
        return console.error(err);
    }
    console.log(data.toString());
});
console.log('代码执行结束2');


/*unblock sample*/
fs.readFile('input.txt', function(err, data) {
    if (err) {
        console.log(err.stack);
        return;
    }
    console.log(data.toString());
});
console.log('代码执行结束3');
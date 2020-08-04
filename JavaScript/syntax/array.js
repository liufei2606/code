
var cars=new Array();
cars[0]="Audi";
cars[1]="BMW";
cars[2]="Volvo";
var cars=new Array("Saab","Volvo","BMW"); // condensed array
var cars=["Audi","BMW","Volvo"]; // literal array

var arr = [1, 2, 3.14, 'Hello', null, true];
arr.length; // 6
arr[0]; // 返回索引为0的元素，即1
arr[5]; // 返回索引为5的元素，即true
arr[6]; // 索引超出了范围，返回undefined

arr.length = 7; // arr变为[1, 2, 3.14, 'Hello', null, true, undefined]
arr.length = 2; // arr变为[1, 2]

arr[1] = 99;  // 修改值

arr[5] = 'x'; // arr变为[1, 2, 3, undefined, undefined, 'x']

arr.indexOf(30); // 元素30没有找到，返回-1
arr.indexOf('30'); // 元素'30'的索引为2

var arr = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
arr.slice(0, 3); // 从索引0开始，到索引3结束，但不包括索引3: ['A', 'B', 'C']
arr.slice(3); // 从索引3开始到结束: ['D', 'E', 'F', 'G']
var aCopy = arr.slice();

var arr = [1, 2];
arr.push('A', 'B'); // 返回Array新的长度: 4 [1, 2, 'A', 'B']
arr.pop(); // pop()返回'B' [1, 2, 'A']
arr.pop(); arr.pop(); arr.pop(); // 连续pop 3次  []
arr.pop(); // 空数组继续pop不会报错，而是返回undefined

var arr = [1, 2];
arr.unshift('A', 'B'); // 返回Array新的长度: 4  ['A', 'B', 1, 2]
arr.shift(); // 'A' ['B', 1, 2]
arr.shift(); arr.shift(); arr.shift(); // 连续shift 3次  []
arr.shift(); // 空数组继续shift不会报错，而是返回undefined []

ar arr = ['Microsoft', 'Apple', 'Yahoo', 'AOL', 'Excite', 'Oracle'];
// 从索引2开始删除3个元素,然后再添加两个元素:
arr.splice(2, 3, 'Google', 'Facebook'); // 返回删除的元素 ['Yahoo', 'AOL', 'Excite']
arr; // ['Microsoft', 'Apple', 'Google', 'Facebook', 'Oracle']
// 只删除,不添加:
arr.splice(2, 2); // ['Google', 'Facebook']
arr; // ['Microsoft', 'Apple', 'Oracle']
// 只添加,不删除:
arr.splice(2, 0, 'Google', 'Facebook'); // 返回[],因为没有删除任何元素
arr; // ['Microsoft', 'Apple', 'Google', 'Facebook', 'Oracle']

var arr = ['A', 'B', 'C'];
var added = arr.concat([1, 2, 3]);
added; // ['A', 'B', 'C', 1, 2, 3]
arr; // ['A', 'B', 'C']
var arr = ['A', 'B', 'C'];
arr.concat(1, 2, [3, 4]); // ['A', 'B', 'C', 1, 2, 3, 4]

var arr = ['A', 'B', 'C', 1, 2, 3];
arr.join('-'); // 'A-B-C-1-2-3'

var x
var mycars = new Array()
mycars[0] = "Saab"
mycars[1] = "Volvo"
mycars[2] = "BMW"

for (x in mycars)
{
    document.write(mycars[x] + "<br />")
}
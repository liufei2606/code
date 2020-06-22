// 为函数的参数指定默认值
function Point(x = 0, y = 0) {
    this.x = x;
    this.y = y;
}

// 重新计算默认值表达式的值
let x = 99;
function foo(p = x + 1) {
    console.log(p);
}
foo(); // 100
x = 100;
foo(); // 101

function foo({ x, y = 5 }) {
    console.log(x, y);
}
foo({}); // undefined 5
foo({ x: 1 }); // 1 5

function fetch(url, { body = "", method = "GET", headers = {} }) {
    console.log(method);
}
fetch("http://example.com", {}); // GET
fetch("http://example.com"); // 报错

// 函数参数的默认值是空对象，但是设置了对象解构赋值的默认值
function m1({ x = 0, y = 0 } = {}) {
    return [x, y];
}
// 参数的默认值是一个有具体属性的对象，但是没有设置对象解构赋值的默认值
function m2({ x, y } = { x: 0, y: 0 }) {
    return [x, y];
}
m1({}); // [0, 0];
m2({}); // [undefined, undefined]

// 如果非尾部参数设置默认值，实际上这个参数没法省略
// 函数length属性，将返回没有指定默认值的参数个数

// 参数的默认值，函数进行声明初始化时，参数会形成一个单独的作用域（context）
let x = 1;
function f(y = x) {
    let x = 2;
    console.log(y);
}
f(); // 1

let foo = "outer";
function bar(func = () => foo) {
    let foo = "inner";
    console.log(func());
}
bar(); // outer

function throwIfMissing() {
    throw new Error("Missing parameter");
}

function foo(mustBeProvided = throwIfMissing()) {
    return mustBeProvided;
}
foo();

//  rest 参数（形式为...变量名），用于获取函数的多余参数
//　rest 参数之后不能再有其他参数（即只能是最后一个参数）
function add(...values) {
    let sum = 0;
    for (var val of values) {
        sum += val;
    }
    return sum;
}
add(2, 5, 3);

function sortNumbers() {
    return Array.prototype.slice.call(arguments).sort();
}
const sortNumbers = (...numbers) => numbers.sort();

// 函数内部可以设定为严格模式,只要函数参数使用了默认值、解构赋值、或者扩展运算符，那么函数内部就不能显式设定为严格模式，否则会报错

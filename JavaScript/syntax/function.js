function abs(x) {
    if (x >= 0) {
        return x;
    } else {
        return -x;
    }
}

function foo() {
    var x = 'Hello, ' + y;
    alert(x);
    var y = 'Bob';
}
foo(); //  Hello, undefined

function foo() {
    var
        x = 1, // x初始化为1
        y = x + 1, // y初始化为2
        z, i; // z和i为undefined
    // 其他语句:
    for (i=0; i<100; i++) {
        ...
    }
}

var abs = function (x) {
    if (x >= 0) {
        return x;
    } else {
        return -x;
    }
};

function foo() {
    if (arguments.length === 0) {
        return 0;
    }
    var x = arguments[0];
    return x >= 0 ? x : -x;
}
foo(-9);

function foo(a, b, ...rest) {
    console.log('a = ' + a);
    console.log('b = ' + b);
    console.log(rest);
}

foo(1, 2, 3, 4, 5);


f.call(o, 1, 2);
f.apply(o, [1, 2]);

var f = new Function("x", "y", "return x*y;");


// 编写一个工具函数将类数组对象转化为真正的数组
function array(a, n) {
  return Array.prototype.slice.call(a, n || 0);
}

// 这个不完全函数实现参数传递至左侧
function partial_left(f /*,...*/) {
  var args = arguments;   // 保存外部实参数组
  return function () {
    var a = array(args, 1);  // 定义一个实参列表，将外部参数排除第一个参数（函数f）后作为初始值
    a = a.concat(array(arguments)); // 然后将所有内部参数添加到这个实参列表
    return f.apply(this, a);  // 最后基于这个实参列表调用函数 f()
  }
}

// 这个不完全函数实现参数传递至右侧
function partial_right(f /*,...*/) {
  var args = arguments;
  return function () {
    var a = array(arguments);  // 定义一个实参列表，将内部参数作为初始值
    a = a.concat(array(args, 1));  // 排除外部参数第一个参数（函数f()）后将其余参数添加到实参列表
    return f.apply(this, a);  // 最后基于这个实参列表调用函数 f()
  }
}

// 这个不完全函数的实参被用作模板，实参列表中的undefined值被内部参数填充
function partial(f /*,...*/) {
  var args = arguments;
  return function () {
    var a = array(args, 1); // 定义一个实参列表，将外部参数排除第一个参数（函数f）后作为初始值
    var i = 0, j = 0;
    // 遍历 args 用内部参数填充外部参数 undefined 值
    for (; i < a.length; i++) {
      if (a[i] === undefined)
        a[i] = arguments[j++];
    }
    // 现在将剩下的内部参数都放进去
    a = a.concat(array(arguments, j));
    return f.apply(this, a);
  }
}

var f = function (x, y, z) {
  return x * (y - z);
};
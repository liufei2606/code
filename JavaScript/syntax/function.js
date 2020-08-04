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
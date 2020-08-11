function Car() {
    this.fuel = 0;
    this.distance = 0;
    this.topSpeed = Math.random();
}

Car.prototype.move = function () {
    if (this.fuel < 1) {
        throw new RangeError("Fuel tank is depleted");
    }
    this.fuel--;
    this.distance += 2;
};

Car.prototype.addFuel = function () {
    if (this.fuel >= 60) {
        throw new RangeError("Fuel tank is full");
    }
    this.fuel++;
};
Car.isFaster = function (left, right) {
    return left.topSpeed > right.topSpeed;
};

// ES6
class Car {
    constructor(speed) {
        this.speed = speed;
        this.fuel = 0;
        this.distance = 0;
        this.topSpeed = Math.random();
    }
    move() {
        if (this.fuel < 1) {
            throw new RangeError("Fuel tank is depleted");
        }
        this.fuel--;
        this.distance += 2;
    }
    addFuel() {
        if (this.fuel >= 60) {
            throw new RangeError("Fuel tank is full");
        }
        this.fuel++;
    }
    // 静态方法
    static isFaster(left, right) {
        return left.topSpeed > right.topSpeed;
    }
}

class Tesla extends Car {
    constructor(speed) {
        // 不调用 super 的话，会报错
        super(speed * 2);
        // 做其他初始化工作 。。。
    }
    move() {
        super.move();
        this.distance += 4;
    }
}

// range2.js 使用构造函数来实现一个能表示值的范围的类

// 这是一个构造函数，用于初始化新创建的「范围对象」
function Range(from, to) {
    // 存储新的「范围对象」的起始位置和结束位置
    // 这两个属性是不可继承的，每个对象都拥有唯一属性
    this.from = from;
    this.to = to;
}

// 所有的「范围对象」都继承自这个对象
// 注意，属性的名字必须是「prototype」
Range.prototype = {
    // 如果 x 在范围内，返回 true，否则返回 false
    // 这个方法可以比较数字范围，也可以比较字符串和日期范围
    includes: function (x) {
        return this.from <= x && x <= this.to;
    },

    // 对于范围内的每个整数都调用一次f
    // 这个方法只用作数字范围
    foreach: function (f) {
        for (var x = Math.ceil(this.from); x <= this.to; x++) {
            f(x);
        }
    },

    // 返回表示这个范围的字符串
    toString: function () {
        return "(" + this.from + "..." + this.to + ")";
    },
};

/**
 * 一个用以定义简单类的函数
 * @param constructor 用于设置实例属性的函数
 * @param methods 实例方法，会被复制到原型对象中
 * @param statics 类属性，会被复制到构造函数中
 * @returns constructor
 */
function defineClass(constructor, methods, statics) {
    if (methods) extend(constructor.prototype, methods);
    if (statics) extend(constructor, statics);
    return constructor;
}

/**
 * 把 p 中的可枚举属性复制到 o 中，并返回 o
 * @param o
 * @param p
 * @returns o
 */
function extend(o, p) {
    for (prop in p) {
        o[prop] = p[prop];
    }
    return o;
}

// 这是 Range 类的另一个实现版本
var SimpleRange = defineClass(
    function (f, t) {
        this.f = f;
        this.t = t;
    },
    {
        includes: function (x) {
            return this.f <= x && x <= this.t;
        },
        toString: function () {
            return this.f + "..." + this.t;
        },
    },
    {
        upto: function (t) {
            return new SimpleRange(0, t);
        },
    }
);

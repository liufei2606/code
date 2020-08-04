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

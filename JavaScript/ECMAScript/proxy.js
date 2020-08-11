var obj = new Proxy(
    {},
    {
        get: function (target, propKey, receiver) {
            console.log(`getting ${propKey}!`);
            return Reflect.get(target, propKey, receiver);
        },
        set: function (target, propKey, value, receiver) {
            console.log(`setting ${propKey}!`);
            return Reflect.set(target, propKey, value, receiver);
        },
    }
);

obj.count = 1;
++obj.count;

var proxy = new Proxy(
    {},
    {
        get: function (target, propKey) {
            return 35;
        },
    }
);
obj = Object.create(proxy);
obj.time;

var handler = {
    get: function (target, name) {
        if (name === "prototype") {
            return Object.prototype;
        }
        return "Hello, " + name;
    },

    apply: function (target, thisBinding, args) {
        return args[0];
    },

    construct: function (target, args) {
        return { value: args[1] };
    },
};

var fproxy = new Proxy(function (x, y) {
    return x + y;
}, handler);

fproxy(1, 2); // 1
new fproxy(1, 2); // {value: 2}
fproxy.prototype === Object.prototype; // true
fproxy.foo === "Hello, foo"; // true

var person = {
    name: "张三",
};

var proxy = new Proxy(person, {
    construct(target, args, newTarget) {
        return new target(...args);
    },
    get: function (target, propKey, receiver) {
        console.log("GET " + propKey);
        if (propKey in target) {
            return target[propKey];
        } else {
            throw new ReferenceError(
                'Prop name "' + propKey + '" does not exist.'
            );
        }
    },

    set: function (obj, prop, value) {
        if (prop === "age") {
            if (!Number.isInteger(value)) {
                throw new TypeError("The age is not an integer");
            }
            if (value > 200) {
                throw new RangeError("The age seems invalid");
            }
        }

        // 对于满足条件的 age 属性以及其他属性，直接保存
        obj[prop] = value;
    },

    apply(target, ctx, args) {
        return Reflect.apply(...arguments);
    },

    has(target, key) {
        if (key[0] === "_") {
            return false;
        }
        return key in target;
    },

    deleteProperty(target, key) {
        invariant(key, "delete");
        delete target[key];
        return true;
    },

    defineProperty(target, key, descriptor) {
        return false;
    },
    getOwnPropertyDescriptor(target, key) {
        if (key[0] === "_") {
            return;
        }
        return Object.getOwnPropertyDescriptor(target, key);
    },
    isExtensible: function (target) {
        console.log("called");
        return true;
    },

    ownKeys(target) {
        return ["a"];
    },
});

proxy.name; // "张三"
proxy.age; // 抛出一个错误

var pipe = function (value) {
    var funcStack = [];
    var oproxy = new Proxy(
        {},
        {
            get: function (pipeObject, fnName) {
                if (fnName === "get") {
                    return funcStack.reduce(function (val, fn) {
                        return fn(val);
                    }, value);
                }
                funcStack.push(window[fnName]);
                return oproxy;
            },
        }
    );

    return oproxy;
};

var double = (n) => n * 2;
var pow = (n) => n * n;
var reverseInt = (n) => n.toString().split("").reverse().join("") | 0;
pipe(3).double.pow.reverseInt.get; // 63

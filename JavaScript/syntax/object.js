
var person = {firstname: 'John', lastname: 'Doe', age: 50, eyecolor: 'blue'};
name = person.lastname;
name = person['lastname'];

var person = new Object;
var person = {
  name: 'Bob',
  age: 20,
  tags: ['js', 'web', 'mobile'],
  city: 'Beijing',
  hasCar: true,
  'middle-school': 'No.1 Middle School',
  zipcode: null,
};

function person(firstname, lastname, age, eyecolor) {
  this.firstname = firstname;
  this.lastname = lastname;
  this.age = age;
  this.eyecolor = eyecolor;

  this.changeName = changeName;
  function changeName(name) {
    this.lastname = name;
  }
  fullName: function() {
    return this.firstName + ' ' + this.lastName;
  }
}
var myMother = new person('Steve', 'Jobs', 48, 'green');

person.name;              // 获取
person.zipcode;           // null
person.address;           // undefined
person['middle-school'];  // 另外一种寻址方式

person.address = 'shanghai' delete person.address

'name' in person;
toString in
    xiaoming;  // true
               // 因为toString定义在object对象中，而所有对象最终都会在原型链上指向object
person.hasOwnProperty('name');      // true
person.hasOwnProperty('toString');  // false

var xiaoming = {
  name: '小明',
  birth: 1990,
  age: function() {
    var y = new Date().getFullYear();
    return y - this.birth;
  }
};

xiaoming.age;           // function xiaoming.age()
xiaoming.age();         // 今年调用是25,明年调用就变成26了
var fn = xiaoming.age;  // 先拿到xiaoming的age函数
fn();  // NaN // strict模式下 Uncaught TypeError: Cannot read property 'birth'
       // of undefined

'use strict';
var xiaoming = {
  name: '小明',
  birth: 1990,
  age: function() {
    function getAgeFromBirth() {
      var y = new Date().getFullYear();
      return y - this.birth;
    }
    return getAgeFromBirth();
  }
};

xiaoming
    .age();  // Uncaught TypeError: Cannot read property 'birth' of undefined
// 报错了！原因是this指针只在age方法的函数内指向xiaoming，在函数内部定义的函数，this又指向undefined了！（在非strict模式下，它重新指向全局对象window！）

'use strict';
var xiaoming = {
  name: '小明',
  birth: 1990,
  age: function() {
    var that = this;  // 在方法内部一开始就捕获this
    function getAgeFromBirth() {
      var y = new Date().getFullYear();
      return y - that.birth;  // 用that而不是this
    }
    return getAgeFromBirth();
  }
};

xiaoming.age();  // 25

function getAge() {
  var y = new Date().getFullYear();
  return y - this.birth;
}

var xiaoming = {name: '小明', birth: 1990, age: getAge};

for (x in xiaoming) {
  txt = txt + person[x];
}

xiaoming.age();              // 25
getAge.apply(xiaoming, []);  // 25, this指向xiaoming, 参数为空

Math.max.apply(null, [3, 5, 4]);  // 5
Math.max.call(null, 3, 5, 4);     // 5

// 想统计一下代码一共调用了多少次parseInt()
var count = 0;
var oldParseInt = parseInt;  // 保存原函数

window.parseInt = function() {
  count += 1;
  return oldParseInt.apply(null, arguments);  // 调用原函数
};

// 测试:
parseInt('10');
parseInt('20');
parseInt('30');
count;  // 3


function employee(name, jobtitle, born) {
  this.name = name;
  this.jobtitle = jobtitle;
  this.born = born;
}
var fred = new employee('Fred Flintstone', 'Caveman', 1970);
employee.prototype.salary = null;
fred.salary = 20000;
document.write(fred.salary);



class Student {
  constructor(name) {
    this.name = name;
  }

  hello() {
    alert('Hello, ' + this.name + '!');
  }
}
var xiaoming = new Student('小明');
xiaoming.hello();

class PrimaryStudent extends Student {
  constructor(name, grade) {
    super(name);  // 记得用super调用父类的构造方法!
    this.grade = grade;
  }

  myGrade() {
    alert('I am at grade ' + this.grade);
  }
}


function Student(name) {
  this.name = name;
  this.hello = function() {
    alert('Hello, ' + this.name + '!');
  }
}

// 原型链：xiaoming ----> Student.prototype ----> Object.prototype ----> null
var xiaoming = new Student('小明');
xiaoming.name;     // '小明'
xiaoming.hello();  // Hello, 小明!

xiaoming.constructor === Student.prototype.constructor;  // true
Student.prototype.constructor === Student;               // true
Object.getPrototypeOf(xiaoming) === Student.prototype;   // true
xiaoming instanceof Student;                             // true

xiaoming.hello === xiaohong.hello;  // false

function Student(name) {
  this.name = name;
}

Student.prototype.hello = function() {
  alert('Hello, ' + this.name + '!');
};

// 升级
function Student(props) {
  this.name = props.name || '匿名';  // 默认值为'匿名'
  this.grade = props.grade || 1;     // 默认值为1
}

Student.prototype.hello = function() {
  alert('Hello, ' + this.name + '!');
};

function createStudent(props) {
  return new Student(props || {})
}
var xiaoming = createStudent({name: '小明'});
xiaoming.grade;

var point = {x: 1, y: 2};
var r = new RegExp('laravel');

var o2 = Object.create(Object.prototype);

Object.getOwnPropertyDescriptor({x: 1}, 'x')
Object.getOwnPropertyDescriptor({x: 1}, 'toString')
Object.defineProperty(
    {}, 'x', {value: 1, writable: true, enumerable: true, configurable: true})


    // range.js 实现了一个能表示值的范围的类

// 通过该方法定义继承自原型 p 的新对象
function inherit(p) {
  if (p == null) throw TypeError();
  if (Object.create)
    return Object.create(p);
  var t = typeof p;
  if (t !== 'function' && t !== 'object') throw TypeError();
  function f() {};
  f.prototype = p;
  return new f();
}

// 这个工厂方法返回一个新的「范围对象」
function range(from, to) {
  // 使用 inherit 函数来创建对象，这个对象继承自下面定义的原型对象
  // 原型对象作为函数的一个属性存储，并定义所有「范围对象」所共享的方法
  var r = inherit(range.methods);

  // 存储新的「范围对象」的起始位置和结束位置
  // 这两个属性是不可继承的，每个对象都拥有唯一属性
  r.from = from;
  r.to = to;

  // 返回这个新创建的对象
  return r;
}

// 原型对象定义方法，这些方法为每个范围对象所继承
range.methods = {
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
  }
};
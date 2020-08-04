
var age = 20;
if (age >= 18) { // 如果age >= 18为true，则执行if语句块
    alert('adult');
} else { // 否则执行else语句块
    alert('teenager');
}

var age = 3;
if (age >= 18) {
    alert('adult');
} else if (age >= 6) {
    alert('teenager');
} else {
    alert('kid');
}

// 多重判断时使用 Array.includes
function test(fruit) {
  const redFruits = ['apple', 'strawberry', 'cherry', 'cranberries'];

  if (redFruits.includes(fruit)) {
    console.log('red');
  }
}

//_ 当发现无效语句时，尽早Return
function test(fruit, quantity) {
  const redFruits = ['apple', 'strawberry', 'cherry', 'cranberries'];

  // 条件 1: 尽早抛出错误
  if (!fruit) throw new Error('No fruit!');
  // 条件 2: 当水果不是红色时停止继续执行
  if (!redFruits.includes(fruit)) return;

  console.log('red');

  // 条件 3: 必须是大质量的
  if (quantity > 10) {
    console.log('big quantity');
  }
}

// 使用默认参数和解构
function test(fruit, quantity = 1) {
  // 如果 quantity 参数没有传入，设置默认值为 1
  if (!fruit) return;
  console.log(`We have ${quantity} ${fruit}!`);
}
test('banana'); // We have 1 banana!
test('apple', 2); // We have 2 apple!

function test(fruit) {
  // 当值存在时打印 fruit 的值
  if (fruit && fruit.name)  {
    console.log (fruit.name);
  } else {
    console.log('unknown');
  }
}
test(undefined); // unknown
test({ }); // unknown
test({ name: 'apple', color: 'red' }); // apple

// 解构 - 仅仅获取 name 属性 为其赋默认值为空对象
function test({name} = {}) {
  console.log (name || 'unknown');
}
test(undefined); // unknown
test({ }); // unknown
test({ name: 'apple', color: 'red' }); // apple

function test(fruit) {
  // 获取属性名，如果属性名不可用，赋默认值为 unknown
  console.log(__.get(fruit, 'name', 'unknown');
}
test(undefined); // unknown
test({ }); // unknown
test({ name: 'apple', color: 'red' }); // apple

// 倾向于对象遍历而不是Switch语句
const fruitColor = {
  red: ['apple', 'strawberry'],
  yellow: ['banana', 'pineapple'],
  purple: ['grape', 'plum']
};

function test(color) {
  //return fruitColor[color] || [];
  // return fruitColor.get(color) || [];
  return fruits.filter(f => f.color == color);
}
// 对 所有/部分 判断使用Array.every & Array.some
const fruits = [
    { name: 'apple', color: 'red' },
    { name: 'banana', color: 'yellow' },
    { name: 'grape', color: 'purple' }
];

function test() {
  // 条件：任何一个水果是红色
  const isAnyRed = fruits.some(f => f.color == 'red');

  console.log(isAnyRed); // true
}

var day=new Date().getDay();
switch (day)
{
case 0:
  x="Today it's Sunday";
  break;
case 1:
  x="Today it's Monday";
  break;
case 2:
  x="Today it's Tuesday";
  break;
case 3:
  x="Today it's Wednesday";
  break;
case 4:
  x="Today it's Thursday";
  break;
case 5:
  x="Today it's Friday";
  break;
case 6:
  x="Today it's Saturday";
  break;
default:
  x="Looking forward to the Weekend";
}

var x = 0;
var i;
for (i=1; i<=10000; i++) {
    x = x + i;
}
x;

var arr = ['Apple', 'Google', 'Microsoft'];
for (var i=0,len=arr.length; i<len; i++)
{
  document.write(cars[i] + "<br>");
}

var x = 0;
for (;;) { // 将无限循环下去
    if (x > 100) {
        break; // 通过if判断来退出循环
    }
    x ++;
}

var o = {
    name: 'Jack',
    age: 20,
    city: 'Beijing'
};
for (var key in o) {
    if (o.hasOwnProperty(key)) {
        alert(key); // 'name', 'age', 'city'
    }
}

var a = ['A', 'B', 'C'];
for (var i in a) {
    alert(i); // '0', '1', '2'
    alert(a[i]); // 'A', 'B', 'C'
}

var x = 0;
var n = 99;
while (n > 0) {
    x = x + n;
    n = n - 2;
}

var n = 0;
do {
    n = n + 1;
} while (n < 100);

var txt="";
function message()
    {
    try
      {
        adddlert("Welcome guest!");
      }
    catch(err)
      {
          txt="There was an error on this page.\n\n";
          txt+="Error description: " + err.message + "\n\n";
          txt+="Click OK to continue.\n\n";
          alert(txt);
      }
    }
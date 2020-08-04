var m = new Map([
    ["Michael", 95],
    ["Bob", 75],
    ["Tracy", 85],
]);
m.get("Michael");

var m = new Map(); // 空Map
m.set("Adam", 67); // 添加新的key-value
m.set("Bob", 59);
m.has("Adam"); // 是否存在key 'Adam': true
m.get("Adam"); // 67
m.delete("Adam"); // 删除key 'Adam'
m.get("Adam"); // undefined

var s1 = new Set(); // 空Set
var s2 = new Set([1, 2, 3]); // 含1, 2, 3
s.add(4);
s.delete(3);

var a = ["A", "B", "C"];
var s = new Set(["A", "B", "C"]);
var m = new Map([
    [1, "x"],
    [2, "y"],
    [3, "z"],
]);
for (var x of a) {
    // 遍历Array
    alert(x);
}
for (var x of s) {
    // 遍历Set
    alert(x);
}
for (var x of m) {
    // 遍历Map
    alert(x[0] + "=" + x[1]);
}

var a = ["A", "B", "C"];
a.forEach(function (element, index, array) {
    // element: 指向当前元素的值
    // index: 指向当前索引
    // array: 指向Array对象本身
    alert(element);
});
var s = new Set(["A", "B", "C"]);
s.forEach(function (element, sameElement, set) {
    alert(element);
});
var m = new Map([
    [1, "x"],
    [2, "y"],
    [3, "z"],
]);
m.forEach(function (value, key, map) {
    alert(value);
});

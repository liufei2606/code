// alert('hello world in TypeScript!');
var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
// 类型批注
// function area(shape: string, width: number, height: number) {
//   var area = width * height;
//   return "I'm a " + shape + " with an area of " + area  + " cm aquard ";
// }
//
// document.body.innerHTML = area('rectangle', 30, 15);
// 接口
// interface Shape {
//   name: string;
//   width: number;
//   height: number;
//   color: string;
// }
//
// function area(shape: Shape) {
//   var area = shape.width * shape.height;
//   return "I'm a " + shape.name + " with an area of " + area  + " cm aquard ";
// }
//
// console.log( area( {name: "square", width: 30, height: 30, color: "blue"} ) );
// 箭头函数表达式
// var shape = {
//     name: "rectangle",
//     popup: function() {
//
//         console.log('This inside popup(): ' + this.name);
//
//         setTimeout(function() {
//             console.log('This inside setTimeout(): ' + this.name);
//             console.log("I'm a " + this.name + "!");
//         }, 3000);
//
//     }
// };
//
// shape.popup();
// 类
var Shape = (function () {
    function Shape(name, width, height) {
        this.name = name;
        this.width = width;
        this.height = height;
        this.area = width * height;
        this.color = "pink";
    }
    ;
    Shape.prototype.shoutout = function () {
        return "I'm " + this.color + " " + this.name + " with an area of " + this.area + " cm squared.";
    };
    return Shape;
}());
var square = new Shape("square", 30, 30);
console.log(square.shoutout());
console.log('Area of Shape: ' + square.area);
console.log('Name of Shape: ' + square.name);
console.log('Color of Shape: ' + square.color);
console.log('Width of Shape: ' + square.width);
console.log('Height of Shape: ' + square.height);
// 继承
var Shape3D = (function (_super) {
    __extends(Shape3D, _super);
    function Shape3D(name, width, height, length) {
        var _this = 
        // super 方法调用了基类 Shape 的构造函数 Shape
        _super.call(this, name, width, height) || this;
        _this.name = name;
        _this.volume = length * _this.area;
        return _this;
    }
    ;
    Shape3D.prototype.shoutout = function () {
        return "I'm " + this.name + " with a volume of " + this.volume + " cm cube.";
    };
    Shape3D.prototype.superShout = function () {
        return _super.prototype.shoutout.call(this);
    };
    return Shape3D;
}(Shape));
var cube = new Shape3D("cube", 30, 30, 30);
console.log(cube.shoutout());
console.log(cube.superShout());

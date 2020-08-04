document.write("Hello Javascript");

var w =
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;
var h =
    window.innerHeight ||
    document.documentElement.clientHeight ||
    document.body.clientHeight;

function timedMsg() {
    var t = setTimeout("alert('5 秒！')", 5000);
}
var c = 0; // 无穷循环中的计时事件
var t;
function timedCount() {
    document.getElementById("txt").value = c;
    c = c + 1;
    t = setTimeout("timedCount()", 1000);
}

function stopCount() {
    clearTimeout(t);
}

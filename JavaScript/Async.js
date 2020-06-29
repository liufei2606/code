async function asyncFn() {
    console.log(1);
    const result = await new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log(2);
            resolve('resolve');
        }, 1000);
    });
    console.log(result);
    console.log(3);
}
asyncFn().then(() => console.log(4));
return;

let p = new Promise((resolve, reject) => {
    reject('reject')
    resolve('success') // 无效代码不会执行
})
p.then(
    value => {
        console.log(value)
    },
    reason => {
        console.log(reason) //reject
    }
)

function* foo(x) {
    let y = 2 * (yield(x + 1))
    let z = yield(y / 3)
    return x + y + z
}
let it = foo(5)
console.log(it.next())
console.log(it.next(12))
console.log(it.next(13))

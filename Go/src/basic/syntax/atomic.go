package main

import (
	"fmt"
	"sync/atomic"
)

// 中断其实是 CPU 和操作系统级别的术语，并发执行的协程并不是真的并行执行，而是通过 CPU 调度不断从运行状态切换到非运行状态，或者从非运行状态切换到运行状态，在用户看来，好像是「同时」在执行
// 把代码从运行状态切换到非运行状态称之为中断。中断的时机很多，比如任何两条语句执行的间隙，甚至在某条语句执行的过程中都是可以的，即使这些语句在临界区内也是如此。所以说互斥锁只能保证临界区代码的串行执行，不能保证这些代码执行的原子性，因为原子操作不能被中断
// 原子操作通常是 CPU 和操作系统提供支持的，由于执行过程中不会中断，所以可以完全消除竞态条件，从而绝对保证并发安全性，此外由于不会中断，所以原子操作本身要求也很高，既要简单，又要快速
// Go 语言的原子操作也是基于 CPU 和操作系统的，由于简单和快速的要求，只针对少数数据类型的值提供了原子操作函数，这些函数都位于标准库代码包 sync/atomic
// 原子操作:加法（Add）、比较并交换（Compare And Swap，简称 CAS）、加载（Load）、存储（Store）和交换（Swap）

type Value struct {
	v interface{}
}

func main() {
	var i int32 = 1
	atomic.AddInt32(&i, 1)
	fmt.Println("i = i + 1 =", i)
	atomic.AddInt32(&i, -1)
	fmt.Println("i = i - 1 =", i)

	// 第一个参数是操作数对应的指针，第二、三个参数是待比较和交换的旧值和新值
	var a int32 = 1
	var b int32 = 2
	var c int32 = 2
	atomic.CompareAndSwapInt32(&a, a, b)
	atomic.CompareAndSwapInt32(&b, b, c)
	fmt.Println("a, b, c:", a, b, c)

	// 加载 仅传递一个参数，即待操作数对应的指针，并且有一个返回值，返回传入指针指向的值
	// 当读取该指针指向的值时，CPU 不会执行任何其它针对此值的读写操作
	var x int32 = 100
	y := atomic.LoadInt32(&x)
	fmt.Println("x, y:", x, y)

	// 存储 第一个参数表示待操作变量对应的指针，第二个参数表示要存储到待操作变量的数值
	// 看作是加载操作的逆向操作，一个用于读取，一个用于写入，通过上述原子函数存储数值的时候，不会出现存储流程进行到一半被中断的情况
	var x1 int32 = 120
	atomic.StoreInt32(&y, atomic.LoadInt32(&x1))
	fmt.Println("x1, y:", x1, y)

	// 交换不关心待操作数的旧值，不管旧值和新值是否相等，都会通过新值替换旧值，有一个返回值，会返回旧值
	var j int32 = 1
	var k int32 = 2
	j_old := atomic.SwapInt32(&j, k)
	fmt.Println("old,new:", j_old, j)

	// 在 1.4 版本发布的时候向 sync/atomic 包中添加了一个新的类型 Value，此类型值相当于一个容器，可以被用来「原子地」存储和加载任意的值
	// 存储值不能是 nil；其次，向原子类型存储的第一个值，决定了它今后能且只能存储该类型的值。如果违背这两条，编译时会抛出 panic
	var v atomic.Value
	v.Store(100)
	fmt.Println("v:", v.Load())
}

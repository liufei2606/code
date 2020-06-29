package main

import (
	"fmt"
	"runtime"
	"sync"
	"time"
)

func add2(a, b int) {
	var c = a + b
	fmt.Printf("%d + %d = %d\n", a, b, c)
}

// share memory
var counter int = 0

func add3(a, b int, lock *sync.Mutex) {
	c := a + b
	lock.Lock()
	counter++
	fmt.Printf("%d: %d + %d = %d\n", counter, a, b, c)
	lock.Unlock()
}

// communication:通道是 Go 语言在语言级别提供的协程通信方式，是一种数据类型，本身是并发安全的，可以使用它在多个 goroutine 之间传递消息，而不必担心通道中的值被污染
// 通道是进程内的通信方式，通过通道传递对象的过程和调用函数时参数传递行为一致，也可以传递指针
// 如果需要跨进程通信，建议通过分布式系统的方法来解决，比如使用 Socket 或者 HTTP 等通信协议
func add4(a, b int, ch chan int) {
	c := a + b
	fmt.Printf("%d + %d = %d\n", a, b, c)
	ch <- 1
}

func main() {
	// 协程是无序的，不知道什么时候所有协程都结束
	for i := 0; i < 10; i++ {
		go add2(4, i)
	}
	time.Sleep(1e9)
	fmt.Println("并发协程执行结束")

	// 共享内存 互斥锁：避免全局变量污染
	start := time.Now()
	lock := &sync.Mutex{}
	for i := 0; i < 10; i++ {
		go add3(1, i, lock)
	}
	for {
		lock.Lock()
		c := counter
		lock.Unlock()
		runtime.Gosched()
		if c >= 10 {
			break
		}
	}
	end := time.Now()
	consume := end.Sub(start).Seconds()
	fmt.Println("程序执行耗时(s)：", consume)

	// 通道通信：压栈方式，实现锁的 标记形式
	// 实现压栈 出栈操作
	start = time.Now()
	chs := make([]chan int, 10)
	for i := 0; i < 10; i++ {
		chs[i] = make(chan int)
		go add4(1, i, chs[i])
	}

	for _, ch := range chs {
		<-ch
	}
	end = time.Now()
	consume = end.Sub(start).Seconds()
	fmt.Println("cousume(s):", consume)
}

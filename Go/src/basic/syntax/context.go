package main

import (
	"context"
	"fmt"
	"sync/atomic"
	"time"
)

func AddNum(a *int32, b int, deferFunc func()) {
	defer func() {
		deferFunc()
	}()

	for i := 0; ; i++ {
		curNum := atomic.LoadInt32(a)
		newNum := curNum + 1
		time.Sleep(time.Millisecond * 200)
		if atomic.CompareAndSwapInt32(a, curNum, newNum) {
			fmt.Printf("number当前值: %d [%d-%d]\n", *a, b, i)
			break
		} else {
			//fmt.Printf("The CAS operation failed. [%d-%d]\n", b, i)
		}
	}
}

func main() {
	total := 10
	var num int32

	fmt.Printf("number初始值: %d\n", num)
	fmt.Println("启动子协程...")
	// 通过 withXXX 方法返回一个从父 Context 拷贝 新的可撤销子 Context 对象和对应撤销函数 CancelFunc
	// 当满足某种条件时，可以通过调用 CancelFunc 函数结束所有子协程的运行，主协程在接收到信号后可以继续往后执行
	ctx, cancelFunc := context.WithCancel(context.Background())
	for i := 0; i < total; i++ {
		go AddNum(&num, i, func() {
			if atomic.LoadInt32(&num) == int32(total) {
				cancelFunc()
			}
		})
	}

	<-ctx.Done()
	fmt.Println("所有子协程执行完毕.")

	// WithDeadline 和 WithTimeout 分别比 WithCancel 多了一个 deadline 和 timeout 时间参数，表示子 Context 存活的最长时间，如果超过了该时间，会自动撤销对应的子 Context。相应的，在调用 <-cxt.Done() 等待子协程执行结束时，如果没有调用 cancelFunc 函数的话它们会等待过期时间到达自动关闭
}

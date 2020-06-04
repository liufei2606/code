package main

import (
	"fmt"
	"sync"
	"time"
)

// sync.WaitGroup:代替声明与协程同样容量的channel
// 现一主多子的协程协作。注意:类型计数器不能小于0，否则会抛出如下 panic
func add_num(a, b int, deferFunc func()) {
	defer func() {
		deferFunc()
	}()
	c := a + b
	fmt.Printf("%d + %d = %d\n", a, b, c)
}

// sync.Once 主要用途是保证指定函数代码只执行一次，类似于单例模式，常用于应用启动时的一些全局初始化操作。只提供了一个 Do 方法，该方法只接受一个参数，且参数类型必须是 func()，即无参数无返回值的函数类型
func dosomething(o *sync.Once) {
	fmt.Println("Start:")
	o.Do(func() {
		fmt.Println("Do Something...")
	})
	fmt.Println("Finished.")
}

func main() {
	var wg sync.WaitGroup
	wg.Add(10)
	for i := 0; i < 10; i++ {
		go add_num(i, i, wg.Done)
	}
	wg.Wait()

	// 不知道子协程总量
	total := 10
	step := 2
	fmt.Println("启动子协程...")
	for i := 0; i < total; i = i + step {
		wg.Add(step)
		for j := 0; j < step; j++ {
			go add_num(i+j, 1, wg.Done)
		}
		wg.Wait()
	}
	fmt.Println("所有子协程执行完毕.")

	o := &sync.Once{}
	go dosomething(o)
	go dosomething(o)
	time.Sleep(time.Second * 1)
}

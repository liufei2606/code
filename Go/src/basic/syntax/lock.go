package main

import (
	"bytes"
	"fmt"
	"io"
	"sync"
	"time"
)

// 设置程序运行时可以使用的最大核心数,解决方案:锁机制
// 竞态条件（race condition）:数据被多个线程共享，那么就很可能会产生争用和冲突的情况.会破坏共享数据的一致性
// 同步的用途有两个，一个是避免多个线程在同一时刻操作同一个数据块，另一个是协调多个线程避免它们在同一时刻执行同一个代码块。但是目的是一致的，那就是保证共享数据原子操作和一致性
// 控制多个线程对共享资源的访问：一个线程在想要访问某一个共享资源的时候，需要先申请对该资源的访问权限，并且只有在申请成功之后，访问才能真正开始；而当线程对共享资源的访问结束时，还必须归还对该资源的访问权限，若要再次访问仍需申请
// 保证多个并发运行的线程对这个共享资源的访问是完全串行的，只要一个代码片段需要实现对共享资源的串行化访问，就可以被视为一个临界区（critical section），由于要访问到资源而必须进入的那个区域
// 临界区总是需要通过同步机制进行保护的，否则就会产生竞态条件，导致数据不一致

// 互斥量（mutual exclusion，简称 mutex）:该类型的值可以被称为互斥锁。一个互斥锁可以被用来保护一个临界区，通过它来保证在同一时刻只有一个 goroutine 处于该临界区之内
//    不要重复锁定互斥锁
//    不要忘记解锁互斥锁，必要时使用 defer 语句
//    不要对尚未锁定或者已解锁的互斥锁解锁
//    不要在多个函数之间直接传递互斥锁
// 互斥锁是一个同步工具，可以保证每一时刻进入临界区的协程只有一个；读写锁对共享资源的写操作和读操作区别看待，并消除了读操作之间的互斥
// Mutex:不管是读操作还是写操作都会阻塞

// RWMutex:读/写互斥锁，简称读写锁，这是一个是单写多读模型
// 读锁占用的情况下，会阻止写，但不阻止读，也就是多个 goroutine 可同时获取读锁，调用 RLock() 方法开启，通过 RUnlock 方法释放
// 写锁会阻止任何其他 goroutine（无论读和写）进来，整个锁相当于由该 goroutine 独占，和 Mutex 一样，写锁通过 Lock 方法启用，通过 Unlock 方法释放，从 RWMutex 的底层实现看实际上是组合了 Mutex

// sync.Cond 的主要作用并不是保证在同一时刻仅有一个线程访问某一个共享资源，而是在对应的共享资源状态发送变化时，通知其它因此而阻塞的线程。条件变量总是和互斥锁组合使用，互斥锁为共享资源的访问提供互斥支持，而条件变量可以就共享资源的状态变化向相关线程发出通知，重在「协调」
// 用于协调想要访问共享资源的那些线程，当共享资源的状态发生变化时，它可以被用来通知被互斥锁阻塞的线程，它既可以基于互斥锁，也可以基于读写锁

// 数据 bucket
type DataBucket struct {
	buffer *bytes.Buffer //缓冲区
	mutex  *sync.RWMutex //互斥锁
	cond   *sync.Cond    //条件变量
}

func NewDataBucket() *DataBucket {
	buf := make([]byte, 0)
	db := &DataBucket{
		buffer: bytes.NewBuffer(buf),
		mutex:  new(sync.RWMutex),
	}
	db.cond = sync.NewCond(db.mutex.RLocker())
	return db
}

// 读取器
func (db *DataBucket) Read(i int) {
	db.mutex.RLock()         // 打开读锁
	defer db.mutex.RUnlock() // 结束后释放读锁
	var data []byte
	var d byte
	var err error
	for {
		//每次读取一个字节
		if d, err = db.buffer.ReadByte(); err != nil {
			if err == io.EOF { // 缓冲区数据为空时执行
				if string(data) != "" { // data 不为空，则打印它
					fmt.Printf("reader-%d: %s\n", i, data)
				}
				db.cond.Wait()  // 缓冲区为空，通过 Wait 方法等待通知，进入阻塞状态
				data = data[:0] // 将 data 清空
				continue
			}
		}
		data = append(data, d) // 将读取到的数据添加到 data 中
	}
}

// 写入器
func (db *DataBucket) Put(d []byte) (int, error) {
	db.mutex.Lock()         // 打开写锁
	defer db.mutex.Unlock() // 结束后释放写锁
	//写入一个数据块
	n, err := db.buffer.Write(d)
	db.cond.Signal() // 写入数据后通过 Signal 通知处于阻塞状态的读取器
	return n, err
}

func main() {
	db := NewDataBucket()
	for i := 1; i < 3; i++ { // 启动多个读取器
		go db.Read(i)
	}
	for j := 0; j < 10; j++ { // 启动多个写入器
		go func(i int) {
			d := fmt.Sprintf("data-%d", i)
			db.Put([]byte(d)) // 写入数据到缓冲区
		}(j)
		time.Sleep(100 * time.Millisecond) // 每次启动一个写入器暂停100ms，让读取器阻塞
	}
}

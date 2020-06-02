package main

import "fmt"

func swap(a, b int) {
	a, b = b, a
	fmt.Println(a, b)
}
func swapByPointer(a, b *int) {
	*a, *b = *b, *a
	fmt.Println(*a, *b)
}

func main() {
	a := 100
	var ptr *int
	fmt.Println(ptr)
	// 指针指向的内存地址的大小是固定的，在 32 位机器上占 4 个字节，在 64 位机器上占 8 个字节，这与指针指向内存地址存储的值类型无关
	ptr = &a
	fmt.Println(ptr)
	fmt.Println(*ptr)

	b := 2
	// 修改的考别
	swap(a, b)
	fmt.Println(a, b)
	swapByPointer(&a, &b)
	//  类型指针:允许对这个指针类型的数据进行修改指向其它内存地址，传递数据时如果使用指针则无须拷贝数据从而节省内存空间，此外和 C 语言中的指针不同，Go 语言中的类型指针不能进行偏移和运算，因此更为安全

	//    数组切片
}

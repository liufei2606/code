package main

import "fmt"

func printError() {
	fmt.Println("兜底执行")
}

func main() {
	// 会在函数执行完成后或读取文件过程中抛出错误时执行
	// 一个函数/方法中可以存在多个 defer 语句，defer 语句的调用顺序遵循先进后出的原则
	// 要尽量在函数/方法的前面定义它们，以免在后面执行时漏掉
	defer printError()
	defer func() {
		fmt.Println("除数不能是0!")
	}()

	var i = 1
	var j = 0
	var k = i / j

	fmt.Printf("%d / %d = %d\n", i, j, k)
}

package main

import (
	"fmt"
	"os"
	"strconv"
)

func main() {
	fmt.Print("hello world", " i am ready to go :)\n")
	fmt.Println("hello world", "i am ready to go :)")
	fmt.Println(os.Args)

	// 获取环境变量
	fmt.Println(os.Getenv("type"), os.Getenv("name"), os.Getenv("GOROOT"))

	for idx, args := range os.Args {
		fmt.Println("参数"+strconv.Itoa(idx)+":", args)
	}
}

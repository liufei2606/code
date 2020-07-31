package main

import (
	"fmt"
	"github.com/golang/protobuf/proto"
	hello "hello/proto"
	"io/ioutil"
)

func main() {
	in, err := ioutil.ReadFile("log")
	if err != nil {
		fmt.Printf("文件读取失败: %v\n", err)
		return
	}
	message := &hello.HelloWorld{}
	if err := proto.Unmarshal(in, message); err != nil {
		fmt.Printf("消息解码失败: %v\n", err)
		return
	}
	fmt.Println("读取文件内容并解码消息成功: ", message)
}
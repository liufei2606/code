package main

import (
	"fmt"
)

// 申明一个结构体，类似PHP的Light类
type Light struct {
	Status string
}

//添加一个On方法
func (l Light) On() string {
	l.Status = "light is on"
	return l.Status
}

//添加一个Off方法
func (l Light) Off() string {
	l.Status = "light is off"
	return l.Status
}

func main() {
	// 初始化类
	l := Light{}
	fmt.Println(l.On())
	fmt.Println(l.Off())

	var i interface{} = "hello"
	s := i.(string)
	fmt.Println(s)

	s, ok := i.(string)
	fmt.Println(s, ok)

	f, ok := i.(float64)
	fmt.Println(f, ok)

	//switch v := i.(type) {
	//}

	// 申明接口有2个方法
	type Switchs interface {
		On() string
		Off() string
	}

}

package main

import (
	"fmt"
)

func main() {
	var int_value_1 int8 // -128-127
	int_value_2 := 45555 // int_value_2 将会被自动推导为 int 类型
	int_value_1 = 127    // 编译错误
	int_value_1 = int8(int_value_2)
	int_value_3 := int_value_1 + int8(int_value_2) // 同类型的整型值不能直接进行算术运算

	// 算术运算符
	int_value_3++ // 只能作为语句，不能作为表达式
	fmt.Println(int_value_1)
	int_value_1 *= int_value_1 // -13* -13? 87

	fmt.Println(int_value_1, int_value_2, int_value_3)

	// 比较运算符
	if int_value_1 < int_value_3 {
		fmt.Println("int_value_1 比 int_value_3 小")
	}

	// 位运算符
	var int_value_bit uint8
	int_value_bit = 255
	int_value_bit = ^int_value_bit
	fmt.Println(int_value_bit)
	int_value_bit = 1
	int_value_bit = int_value_bit << 3
	fmt.Println(int_value_bit) // 8
	fmt.Println(7 & 5)

	// 逻辑运算符
	if int_value_1 < int_value_3 && int_value_1 == -87 {
		fmt.Println("条件为真")
	}

	// 数据类型转化
	v21 := uint(16)    // 初始化 v1 类型为 unit
	v22 := int8(v21)   // 将 v1 转化为 int8 类型并赋值给 v2
	v23 := uint16(v22) // 将 v2 转化为 uint16 类型并赋值给 v3
	v24 := uint(255)
	v25 := int8(v24) // v2 = -1
	v26 := 99.99
	v27 := int(v26)
	v28 := float64(v27)
	fmt.Println(v21, v22, v23, v24, v25, v26, v27, v28, "\n")
}

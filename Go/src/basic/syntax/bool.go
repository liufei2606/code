package main

import "fmt"

func main() {
	// 变量类型一旦确定，就不能将其他类型的值赋值给该变量:不能接受其他类型的赋值，也不支持自动或强制的类型转换
	//    布尔值 FALSE 本身
	//    整型值 0（零）
	//    浮点型值 0.0（零）
	//    空字符串，以及字符串 "0"
	//    不包括任何元素的数组
	//    特殊类型 NULL（包括尚未赋值的变量）
	//    从空标记生成的 SimpleXML 对象
	var v1 bool
	v1 = false
	//v1 = bool(0) // error
	v1 = (1 != 0)
	v2 := (1 == 2)

	fmt.Println(v1, v2)
}

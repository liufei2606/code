package main

import (
	"fmt"
	"math"
)

func main() {
	var float_value_1 float32
	float_value_1 = 10

	float_value_2 := 10.0 // 如果不加小数点，float_value_2 会被推导为整型而不是浮点型
	float_value_3 := 1.1e-10

	fmt.Println(float_value_1, float_value_2, float_value_3, float_value_1 == float32(float_value_2))

	// 保证操作数类型一致,浮点数不是一种精确的表达方式，因为二进制无法精确表示所有十进制小数
	// 不要相信浮点数结果精确到了最后一位，也永远不要比较两个浮点数是否相等
	float_value_4 := 0.1
	float_value_5 := 0.7
	float_value_6 := float_value_4 + float_value_5
	fmt.Println(float_value_6)

	// 比较
	p := 0.00001
	if math.Dim(float64(float_value_1), float_value_2) < p {
		fmt.Println("float_value_1 和 float_value_2 相等")
	}

	var complex_value_1 complex64
	complex_value_1 = 1.10 + 10i // 由两个 float32 实数构成的复数类型

	complex_value_2 := 1.10 + 10i        // 和浮点型一样，默认自动推导的实数类型是 float64，所以 complex_value_2 是 complex128 类型
	complex_value_3 := complex(1.10, 10) // 与 complex_value_2 等价
	fmt.Println(imag(complex_value_1), real(complex_value_2), imag(complex_value_3))
}

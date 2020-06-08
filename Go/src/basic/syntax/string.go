package main

import (
	"fmt"
	"strconv"
	"strings"
)

func main() {
	var str string
	str = "Hello World"
	// 字符串是一种不可变值类型，一旦初始化之后，它的内容不能被修改
	ch := str[0]
	str += "!"
	str = str +
		", Henry"
	fmt.Printf("The length of \"%s\" is %d \n", str, len(str))
	fmt.Printf("The first character of \"%s\" is %c.\n", str, ch)
	fmt.Println(str[:5], str[7:], str[8:10])

	for i := 0; i < len(str); i++ {
		//ch := str[i]    // 依据下标取字符串中的字符，类型为byte
		fmt.Println(i, str[i])
	}
	for i, ch := range str {
		fmt.Println(i, ch) // ch 的类型为 rune
	}

	str_2 := "死神来了, 死神"
	comma := strings.Index(str_2, ", ")
	pos := strings.Index(str_2[comma:], "死神")
	fmt.Println(comma, pos, str_2[comma+pos:])

	// 对应的 UTF-8 编码转化为字符串
	v30 := 65
	v31 := string(v30)
	v32 := 30028
	v33 := string(v32)
	// 将字节数组或者 rune（Unicode 编码字符）数组转化为字符串
	v34 := []byte{'h', 'e', 'l', 'l', 'o'}
	v35 := string(v34)
	v36 := []rune{0x5b66, 0x9662, 0x541b}
	v37 := string(v36)
	fmt.Println(v31, v33, v35, v37)

	// 字符串与其他基本数据类型之间转化
	v1 := "100"
	v2, err := strconv.Atoi(v1) // 将字符串转化为整型，v2 = 100
	v4 := strconv.Itoa(v2)      // 将整型转化为字符串, v4 = "100"

	v5 := "true"
	v6, err := strconv.ParseBool(v5) // 将字符串转化为布尔型
	v5 = strconv.FormatBool(v6)      // 将布尔值转化为字符串

	v7 := "100"
	v8, err := strconv.ParseInt(v7, 10, 64) // 将字符串转化为整型，第二个参数表示几进制，第三个参数表示最大位数
	v7 = strconv.FormatInt(v8, 10)          // 将整型转化为字符串，第二个参数表示几进制

	v9, err := strconv.ParseUint(v7, 10, 64) // 将字符串转化为无符号整型，参数含义同 ParseInt
	v7 = strconv.FormatUint(v9, 10)          // 将字符串转化为无符号整型，参数含义同 FormatInt

	v10 := "99.99"
	v11, err := strconv.ParseFloat(v10, 64) // 将字符串转化为浮点型，第二个参数表示精度
	v10 = strconv.FormatFloat(v11, 'E', -1, 64)

	q := strconv.Quote("Hello, 世界")       // 为字符串加引号
	q = strconv.QuoteToASCII("Hello, 世界") // 将字符串转化为 ASCII 编码

	fmt.Println(v2, v4, v5, v6, v7, v8, v9, v10, v11, q, err)
}

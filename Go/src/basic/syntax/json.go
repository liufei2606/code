package main

import (
	"encoding/json"
	"fmt"
)

type User struct {
	Name    string
	Website string
	Age     uint
	Male    bool
	Skills  []string
}

func main() {
	user := User{
		"学院君",
		"https://xueyuanjun.com",
		18,
		true,
		[]string{"Golang", "PHP", "C", "Java", "Python"},
	}

	// 编码
	u, err := json.Marshal(user)
	if err != nil {
		fmt.Printf("JSON 编码失败：%v\n", err)
		return
	}
	fmt.Printf("JSON 格式数据：%s\n", u)

	// 解码
	// 除了 channel、complex 和函数这几种类型外，Go 语言的大多数数据类型都可以转化为有效的 JSON 文本。如果转化前的数据结构中出现指针，那么将会转化指针所指向的值，如果指针指向的是零值，那么 null 将作为转化后的结果输出
	// JSON 转化前后的数据类型映射如下：
	//
	//    布尔值转化为 JSON 后还是布尔类型。
	//    浮点数和整型会被转化为 JSON 里边的常规数字。
	//    字符串将以 UTF-8 编码转化输出为 Unicode 字符集的字符串，特殊字符比如将会被转义为 \u003c。
	//    数组和切片会转化为 JSON 里边的数组，但 []byte 类型的值将会被转化为 Base64 编码后的字符串，slice 类型的零值会被转化为 null。
	//    结构体会转化为 JSON 对象，并且只有结构体里边以大写字母开头的可被导出的字段才会被转化输出，而这些可导出的字段会作为 JSON 对象的字符串索引。
	//    转化一个 map 类型的数据结构时，该数据的类型必须是 map[string]T（T 可以是 encoding/json 包支持的任意数据类型）。

	var user2 User
	err = json.Unmarshal(u, &user2)
	if err != nil {
		fmt.Printf("JSON 解码失败：%v\n", err)
		return
	}
	fmt.Printf("JSON 解码结果: %#v\n", user2)

	// SON 数据的结构和 Go 语言里边的目标类型的结构对不上时,json.Unmarshal() 函数在解码过程中会丢弃该字段
	u2 := []byte(`{"name": "学院君", "website": "https://xueyuanjun.com", "alias": "Laravel学院"}`)
	var user3 User
	err = json.Unmarshal(u2, &user3)
	if err != nil {
		fmt.Printf("JSON 解码失败：%v\n", err)
		return
	}
	fmt.Printf("JSON 解码结果: %#v\n", user3)

	// 不知道要解码的 JSON 数据结构:只需要将这段 JSON 数据解码输出到一个空接口即可
	//     布尔值将会转换为 Go 语言的 bool 类型；
	//    数值会被转换为 Go 语言的 float64 类型；
	//    字符串转换后还是 string 类型；
	//    JSON 数组会转换为 []interface{} 类型；
	//    JSON 对象会转换为map[string]interface{} 类型；
	//    null 值会转换为 nil。
	u3 := []byte(`{"name": "学院君", "website": "https://xueyuanjun.com", "age": 18, "male": true, "skills": ["Golang", "PHP"]}`)
	var user4 interface{}
	err = json.Unmarshal(u3, &user4)
	if err != nil {
		fmt.Printf("JSON 解码失败：%v\n", err)
		return
	}
	fmt.Printf("JSON 解码结果: %#v\n", user4)

	user5, ok := user4.(map[string]interface{})
	if ok {
		for k, v := range user5 {
			switch v2 := v.(type) {
			case string:
				fmt.Println(k, "is string", v2)
			case int:
				fmt.Println(k, "is int", v2)
			case bool:
				fmt.Println(k, "is bool", v2)
			case []interface{}:
				fmt.Println(k, "is an array:")
				for i, iv := range v2 {
					fmt.Println(i, iv)
				}
			default:
				fmt.Println(k, "is another type not handle yet")
			}
		}
	}
}

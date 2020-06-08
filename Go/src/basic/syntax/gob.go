package main

import (
	"bytes"
	"encoding/gob"
	"fmt"
	"log"
)

// Gob 是 Go 语言的一个序列化数据结构的编码解码工具，在 Go 标准库中内置了 encoding/gob 包以供使用
// 一个数据结构使用 Gob 进行序列化之后，能够用于网络传输，典型适用场景就是 RPC 编程
// 发送方和接受方的数据结构并不需要完全一致
// 接收数据结构只要满足与发送数据结构签名一致（与顺序无关，不能类型之间不能相互编解码，整型还要细分为有符号和无符号）、或者是发送数据类型的子集（但不能为空）或超集，即可正常接收并解码
//    struct、array、slice 是可以被编码的，但是 function 和 channel 是不能被编码的；
//    整型分为有符号和无符号，无符号和有符号整型是不能互相编解码的；
//    布尔类型是被当作 uint 来编码的，0 是 false，1 是 true；
//    浮点型的值都是被当作 float64 类型的值来编码的，浮点型和整型也是不能相互编解码的；
//    字符串类型（包含 string 和 []byte）是以无符号字节个数 + 每个字节编码的形式编解码的；
//    数组类型（包含 slice 和 array）是按照无符号元素个数 + 每个数组元素编码的形式进行编解码的；
//    字典类型（map）是按照无符号元素个数 + 键值对这样的形式进行编解码的；
//    结构体类型（struct）是按照序列化的属性名 + 属性值来进行编解码的，其中属性值是其自己对应类型的 Gob 编码，如果有一个属性值为 0 或空，则这个属性直接被忽略，每个属性的序号是由编码时的顺序决定的，从 0 开始顺序递增。struct 在序列化前会以 -1 代表序列化的开始，以 0 代表序列化结束，即 struct 的序列化是按照 “-1 (0 属性1的名字 属性1的值) (1 属性2的名字 属性2的值) 0 ”来进行编码的。
// Gob 是二进制编码的数据流，因此性能和传输效率更高，并且 Gob 流是可以自解释的，从而具备了完整的表达能力
// 无法跨语言使用，只能仅局限于基于 Go 语言开发的 RPC 客户端与服务端进程间通信,需要对 net/rpc 包底层的编解码工具进行自定义，改用跨语言的 JSON 或者 Protobuf 进行数据格式序列化

type P struct {
	X, Y, Z int
	Name    string
	Tags    []string
	Attr    map[string]string
}

type Q struct {
	X, Y *int32
	Name string
	Tags []string
	Attr map[string]string
}

func main() {
	var network bytes.Buffer

	// 数据编码（发送数据时）
	enc := gob.NewEncoder(&network) // 初始化编码器 gob.Encoder
	err := enc.Encode(P{3, 4, 5, "学院君", []string{"PHP", "Laravel", "Go"}, map[string]string{"webiste": "https://xueyuanjun.com"}})
	if err != nil {
		log.Fatal("encode error:", err)
	}

	// 数据解码（收到数据时）
	dec := gob.NewDecoder(&network) // 初始化解码器 gob.Decoder
	var q Q
	err = dec.Decode(&q)
	if err != nil {
		log.Fatal("decode error:", err)
	}
	fmt.Printf("%q: {%d,%d}, Tags: %v, Attr: %v\n", q.Name, *q.X, *q.Y, q.Tags, q.Attr)
}

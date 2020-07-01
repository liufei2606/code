package main

import (
	"fmt"
	"sort"
)

func main() {
	// 无序集合
	var testMap map[string]int
	testMap = map[string]int{
		"one":   1,
		"two":   2,
		"three": 3,
	}

	k := "two"
	v, ok := testMap[k]
	if ok {
		fmt.Printf("The element of key %q: %d\n", k, v)
	} else {
		fmt.Println("Not found!")
	}

	testMap1 := map[string]int{
		"one":   1,
		"two":   2,
		"three": 3,
	}
	fmt.Println(testMap1)

	testMap = make(map[string]int, 100)
	testMap["one"] = 1
	testMap["two"] = 2
	testMap["three"] = 3
	delete(testMap, "two")
	fmt.Println(testMap)

	for key, value := range testMap {
		fmt.Println(key, value)
	}
	for key := range testMap {
		fmt.Println(key)
	}
	for _, value := range testMap {
		fmt.Println(value)
	}

	// k v 互换
	invMap := make(map[int]string, 3)
	for k, v := range testMap {
		invMap[v] = k
	}

	// 对键排序
	keys := make([]string, 0)
	for k := range testMap {
		keys = append(keys, k)
	}
	sort.Strings(keys)
	fmt.Println("Sorted map by key:")
	for _, k := range keys {
		fmt.Println(k, testMap[k])
	}

	// 对值排序
	values := make([]int, 0)
	for _, v := range testMap {
		values = append(values, v)
	}
	sort.Ints(values)
	fmt.Println("Sorted map by value:")
	for _, v := range values {
		fmt.Println(invMap[v], v)
	}
}

package main

import (
	"fmt"
	"github.com/pkg/errors"
)

//  高阶：对函数参数或者返回 通过接口限制
type operate func(x int, y int) int

func calculate(x, y int, op operate) (int, error) {
	if op == nil {
		return 0, errors.New("invalid operation")
	}

	return op(x, y), nil
}

type calculateFunc func(x int, y int) (int, error)

func genCalculator(op operate) calculateFunc {
	return func(x int, y int) (int, error) {
		if op == nil {
			return 0, errors.New("invalid operation")
		}
		return op(x, y), nil
	}
}

func main() {
	x, y := 12, 13
	add := func(x, y int) int {
		return x + y
	}
	result, err := calculate(x, y, add)
	fmt.Printf("The result: %d (error: %v)\n",
		result, err)
	result, err = calculate(x, y, nil)
	fmt.Printf("The result: %d (error: %v)\n\n",
		result, err)

	// 链式操作
	sub := func(x, y int) int {
		return x - y
	}
	m, n := 56, 78
	op := genCalculator(sub)
	rs, error := op(m, n)
	fmt.Printf("The result: %d (error: %v)\n", rs, error)
}

package main

import "fmt"

func main() {
	array1 := [3]string{"a", "b", "c"}
	array2 := modifyArray(array1)
	fmt.Printf("The original array: %v\n", array1)
	fmt.Printf("The modified array: %v\n\n", array2)

	complexArray1 := [3][]string{
		[]string{"d", "e", "f"},
		[]string{"g", "h", "i"},
		[]string{"j", "k", "l"},
	}
	complexArray2 := modifyComplexArray(complexArray1)
	fmt.Printf("The original array: %v\n", complexArray1)
	fmt.Printf("The modified array: %v\n", complexArray2)
}

func modifyArray(a [3]string) [3]string {
	a[1] = "x"
	return a
}

func modifyComplexArray(a [3][]string) [3][]string {
	a[1] = []string{"a", "b", "c"}
	a[2][1] = "z"
	return a
}

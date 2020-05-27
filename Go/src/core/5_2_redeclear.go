package main

import "fmt"

var container = []string{"one", "two", "three"}

func main() {
	container := map[int]string{1:"zero", 2:"first", 3:"second"}
	fmt.Printf("The element is %q. \n", container[1])
}

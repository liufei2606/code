package main

import "fmt"

func main() {
	ch1 := make(chan int, 3)
	ch1 <- 2
	ch1 <- 1
	ch1 <- 3
	eleml := <-ch1
	eleml1 := <-ch1
	eleml2 := <-ch1

	fmt.Printf("The first element received from channel ch1: %v\n", eleml)
	fmt.Printf("The second element received from channel ch1: %v\n", eleml1)
	fmt.Printf("The third element received from channel ch1: %v\n", eleml2)
}

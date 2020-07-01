package main

import "fmt"

var block = "package"

func main()  {
	fmt.Printf("The Block is %s. \n", block)
	block := "function"
	{
		block := "inner"
		fmt.Printf("The Block is %s. \n", block)
	}

	fmt.Printf("The Block is %s. \n", block)
}

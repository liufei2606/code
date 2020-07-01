package main

import (
	"flag"
	"fmt"
)

func main() {
	//var name = flag.String("name", "everyone", "the greeting object")
	name := flag.String("name", "everyone", "the greeting object")
	flag.Parse()
	fmt.Printf("Hello, %v!\n", *name)
}

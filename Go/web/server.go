package main

import (
	"fmt"
	"net/http"
)

func HelloHandler(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "Hello World")
}

type HelloHandlerStruct struct {
	content string
}

func (handler *HelloHandlerStruct) ServeHTTP(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, handler.content)
}

func main () {
	http.HandleFunc("/", HelloHandler)
	http.Handle("/hello", &HelloHandlerStruct{content: "Hello World!"})

	http.ListenAndServe(":8000", nil)
}
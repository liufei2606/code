package main

import (
	"fmt"
	"net/http"
	"strings"
)

func sayHello(w http.ResponseWriter, r *http.Request) {
	r.ParseForm()
	fmt.Println(r.Form)
	fmt.Println(r.URL.Path)
	fmt.Println(r.URL.Scheme)
	for k, v := range r.Form {
		fmt.Println(k, ":", strings.Join(v, ""))
	}
	fmt.Fprintf(w, "你好，学院君！")
}

//func main() {
//	http.HandleFunc("/", sayHello)
//
//	err := http.ListenAndServe(":9091", nil)
//	if err != nil {
//		log.Fatal("ListenAndServe:", err)
//	}
//}

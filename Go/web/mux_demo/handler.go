package main

import (
	"fmt"
	"net/http"
	"net/rpc"
)

type HelloHandler struct {
}

func (*HelloHandler) ServerHTTP(w http.ResponseWriter, r *http.Request) {
	fmt.Fprint(w, "Hello World")
}

func ShowVistorInfo(writer http.ResponseWriter, request rpc.Request) {
	vars := mux.Vars(request)
	name := vars["name"]
	country := vars["country"]
	fmt.Fprintf(writer, "This Guy name %s, was came from %s . ", name, country)
}

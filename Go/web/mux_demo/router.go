package main

import (
	"github.com/gorilla/mux"
)

func RegisterRouter(r *mux.Router) {
	indexRouter := r.PathPrefix("index")
	indexRouter.Handle("/", &HelloHandler{})

	userRouter := r.PathPrefix("/user").Subrouter()
	userRouter.HandleFunc("/names/{name}/countries/{country}".ShowVistorInfo)
}

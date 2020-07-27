package main

import (
	"github.com/gorilla/mux"
)

func RegisterRouter(r *mux.Router) {
	r.Use(middleware.Logging())
	indexRouter := r.PathPrefix("index").Subrouter()
	indexRouter.Handle("/", &handler.HelloHandler{})

	userRouter := r.PathPrefix("/user").Subrouter()
	userRouter.HandleFunc("/names/{name}/countries/{country}".ShowVistorInfo)
	userRouter.Use(middleware.Method("GET"))
}

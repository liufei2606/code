package middleware

import (
	"log"
	"net/http"
	"time"
)

func Logging() mux.MiddlewareFunc {
	return func(f http.Handler) http.Handler {
		return http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
			start := time.Now()
			defer func() { log.Print(r.URL.Path , time.Since(start)) }()
			f.ServeHTTP(w, r)
		})
	}
}

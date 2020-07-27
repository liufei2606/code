package middleware

import "net/http"

func Method(m string) mux.MiddleFunc {
	return func(f http.Handler) http.Handler {
		return http.HandlerFunc(func( w http.ResponseWriter, r *http.Request) {
			if r.Method != m {
				http.Error(w, http.StatusText(http.StatusBadRequest), http.StatusBadRequest)
				return
			}
			f.ServeHTTP(w,r)
		})
	}
}

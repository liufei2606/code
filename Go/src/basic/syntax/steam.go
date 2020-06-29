package main

import (
	"encoding/json"
	"log"
	"os"
)

func main() {
	dec := json.NewDecoder(os.Stdin)
	enc := json.NewEncoder(os.Stdout)
	for {
		var v map[string]interface{}
		if err := dec.Decode(&v); err != nil {
			log.Println(err)
			return
		}

		if err := enc.Encode(&v); err != nil {
			log.Println(err)
		}
	}
}

// got run steam
// {"Name":"学院君","Website":"https://xueyuanjun.com","Age":18,"Male":true,"Skills":["Gola","C","Java","Python"]}

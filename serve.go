package main

import (
	"fmt"
	"log"
	"net/http"
	"os"

	cgi "github.com/vanackere/gofcgisrv"
)

var (
	f       *cgi.FCGIRequester
	docroot string
)

func main() {
	f = cgi.NewFCGI("tcp", "127.0.0.1:9000")

	var err error

	docroot, err = os.Getwd()
	if err != nil {
		log.Fatal("couldn't get current working directory:", err)
	}

	mux := http.NewServeMux()

	mux.HandleFunc("/", phpHandler)

	mux.Handle("/admin", &adminHandler{})

	pubSrv := http.FileServer(http.Dir("public/"))

	mux.Handle("/css/", pubSrv)
	mux.Handle("/js/", pubSrv)
	mux.Handle("/fonts/", pubSrv)
	mux.Handle("/static/", pubSrv)

	mux.Handle("/tmp", http.FileServer(http.Dir("/tmp")))

	log.Fatal(http.ListenAndServe("localhost:8080", mux))
}

type adminHandler struct{}

func (a *adminHandler) ServeHTTP(w http.ResponseWriter, r *http.Request) {
	fmt.Fprint(w, "Admin page!")
}

func phpHandler(w http.ResponseWriter, r *http.Request) {
	log.Printf("%s %s being handled by PHP\n", r.Method, r.RequestURI)

	// needed to get php to work
	env := []string{
		"PHP_DOCUMENT_ROOT=" + docroot,
		"REDIRECT_STATUS=200",
		"SCRIPT_FILENAME=" + docroot + "/public/index.php",
	}

	cgi.ServeHTTP(f, env, w, r)
}

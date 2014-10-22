package main

import (
	"fmt"
	"log"
	"net/http"
	"os"
	"strings"

	cgi "github.com/vanackere/gofcgisrv"
)

var (
	f       *cgi.FCGIRequester
	docroot string
)

func main() {
	// TODO: consistent logging
	// TODO: investigate golang ADN wrappers
	// TODO: make this part customizable (CLI flag?)
	// TODO: abstract fcgi details (esp. env stuff)
	// TODO: extract the serve static files stuff
	f = cgi.NewFCGI("tcp", "127.0.0.1:9000")

	var err error

	docroot, err = os.Getwd()
	if err != nil {
		log.Fatal("couldn't get current working directory:", err)
	}

	mux := http.NewServeMux()

	// all non-matched routes go to php
	mux.HandleFunc("/", phpHandler)

	// this is a dummy route
	mux.Handle("/admin", &adminHandler{})

	pubSrv := serveStatic(http.Dir("public"))

	mux.HandleFunc("/css/", pubSrv)
	mux.HandleFunc("/js/", pubSrv)
	mux.HandleFunc("/fonts/", pubSrv)
	mux.HandleFunc("/static/", pubSrv)

	// listen on 8080
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

func serveStatic(fs http.FileSystem) http.HandlerFunc {
	srv := http.FileServer(fs)

	return func(w http.ResponseWriter, r *http.Request) {
		if strings.HasSuffix(r.URL.Path, "/") {
			http.NotFound(w, r)
			return
		}

		srv.ServeHTTP(w, r)
	}
}

package main

import (
	"time"

	"github.com/jessevdk/go-assets"
)

var _Assets90ba780e7ce0fde2c751eedf5fb441ba62ac6407 = "<!doctype html>\n<body>\n  <p>Hello, {{.Foo}}</p>\n</body>"

// Assets returns go-assets FileSystem
var Assets = assets.NewFileSystem(map[string][]string{"/": []string{"templates"}, "/templates": []string{"html"}, "/templates/html": []string{"index.tmpl"}}, map[string]*assets.File{
	"/": &assets.File{
		Path:     "/",
		FileMode: 0x800001fd,
		Mtime:    time.Unix(1597142542, 1597142542244659619),
		Data:     nil,
	}, "/templates": &assets.File{
		Path:     "/templates",
		FileMode: 0x800001fd,
		Mtime:    time.Unix(1597142928, 1597142928674687704),
		Data:     nil,
	}, "/templates/html": &assets.File{
		Path:     "/templates/html",
		FileMode: 0x800001fd,
		Mtime:    time.Unix(1597142935, 1597142935302465098),
		Data:     nil,
	}, "/templates/html/index.tmpl": &assets.File{
		Path:     "/templates/html/index.tmpl",
		FileMode: 0x1b4,
		Mtime:    time.Unix(1597142935, 1597142935298465229),
		Data:     []byte(_Assets90ba780e7ce0fde2c751eedf5fb441ba62ac6407),
	}}, "")

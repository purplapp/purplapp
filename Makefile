all: build stop start

build:
	docker build -t ciarand/apache-php .

stop:
	docker stop $(docker ps -q) 2>/dev/null || true

start:
	docker run -p 80:80 -v `pwd`:/var/www/html ciarand/apache-php

.PHONY: build stop start

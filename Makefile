build:
	docker build -t "zeit" -f Dockerfile .

run:
	docker run -d --name zeit -p 80:80 -v $(shell pwd)/lib:/var/www/lib zeit

stop:
	docker stop zeit && docker rm zeit

composer:
	composer update -d ./lib

restart:
	make stop && make build && make run

bash:
	docker exec -it zeit bash
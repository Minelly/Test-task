export
.DEFAULT_GOAL := help
.PHONY : help
  : Makefile
	@sed -n 's/^##//p' $<

## up
up:
	docker-compose up -d

## shell
shell:
	docker-compose exec --user=www-data php-fpm bash

## down
down:
	docker-compose down

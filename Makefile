.DEFAULT_GOAL := help

ifndef VERBOSE
.SILENT:
endif

.PHONY: help
help:  ## Print this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		sed 's/Makefile://' | \
		sed 's/include\/.*\.mk://' | \
		sort -d | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: env
env: ## Setup environment file
	cp .env.example .env

.PHONY: up
up: ## Starts docker containers
	docker compose up -d

.PHONY: start
start: ## Start docker containers
	docker compose start

.PHONY: stop
stop: ## Stops docker containers
	docker compose stop

.PHONY: down
down: ## Downs docker containers
	docker compose down

.PHONY: downv
downv: ## Downs docker containers with volumes
	docker compose down -v

.PHONY: exec-php-bash
exec-php-bash: ## Run bash in php docker container
	docker exec -it symfony-assessment-apache-php bash
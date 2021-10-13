###
### PLATFORM
### ¯¯¯¯¯¯¯¯

define docker-compose
	cd ${DC_DIR} && docker-compose -p ${DC_PREFIX} $(1)
endef

platform: .php-version symfony.domain.attach up ## Setup the platform tools
.PHONY: platform

docker.pull: ## Pull the docker images
	$(call docker-compose,pull)
.PHONY: docker.pull

docker.build: ## Build (and pull) the docker images
	$(call docker-compose,build --pull)
.PHONY: docker.build

docker.up: ## Start the docker containers
	$(call docker-compose,up -d)
.PHONY: docker.up

docker.stop: ## Stop the docker containers
	$(call docker-compose,stop)
.PHONY: docker.stop

docker.down: ## Stop and remove the docker containers
	$(call docker-compose,down)
.PHONY: docker.down

docker.dc: ARGS=ps
docker.dc: ## Run docker-compose command. Use ARGS="" to pass parameters to docker-compose.
	$(call docker-compose,${ARGS})
.PHONY: docker.dc

server.start: ## Run the local webserver using Symfony
ifneq (${SYMFONY_USE_DOCKER_ONLY},1)
	${SYMFONY} local:server:start -d
endif

server.stop: ## Stop the local webserver
ifneq (${SYMFONY_USE_DOCKER_ONLY},1)
	${SYMFONY} local:server:stop
endif

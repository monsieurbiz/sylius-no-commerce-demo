###
### SYMFONY
### ¯¯¯¯¯¯¯

define symfony
	if [[ "$(2)" != "" ]]; \
	    then echo "(cd $(1) && symfony $(2))"; \
	    (cd $(1) && symfony $(2)); \
	else \
	    echo "(cd ${APP_DIR} && symfony $(1))"; \
	    (cd ${APP_DIR} && symfony $(1)); \
	fi;
endef

ifeq (${SYMFONY_USE_DOCKER_ONLY},1)
define symfony.console
	$(call docker-compose,exec --user www-data ${BASH_CONTAINER} bash -c "cd ${APP_DIR}; ./bin/console $(1)")
endef
else
define symfony.console
	cd ${APP_DIR} && symfony console $(1)
endef
endif

ifeq (${SYMFONY_USE_DOCKER_ONLY},1)
define symfony.composer
	$(call docker-compose,exec --user www-data ${BASH_CONTAINER} bash -c "cd ${APP_DIR}; composer $(1)")
endef
else
define symfony.composer
	cd ${APP_DIR} && symfony composer $(1)
endef
endif

symfony.domain.attach: ## Attach domains to symfony proxy
ifneq (${SYMFONY_USE_DOCKER_ONLY},1)
	@for domain in ${DOMAINS}; \
	do \
	    folder=`echo $$domain | cut -d: -f 1`;  \
	    host=`echo $$domain | cut -d: -f 2 | sed 's/,/ /g'`; \
	    $(call symfony,$$folder,local:proxy:domain:attach $$host || true) \
	done;
endif

symfony.server.start: ## Serve the app
ifneq (${SYMFONY_USE_DOCKER_ONLY},1)
ifeq (${SYMFONY_NO_TLS},1)
	@$(call symfony,serve --no-tls -d || true)
else
	@$(call symfony,serve -d || true)
endif
endif

symfony.server.stop: ## Serve the app
	@$(call symfony,local:server:stop || true)

symfony.server.restart: symfony.server.stop symfony.server.start ## Restart the app

symfony.server.log: ## Tail the logs
	@$(call symfony,local:server:log)

symfony.migration.generate: ## Generate migration file
	$(call symfony.console, doctrine:migrations:diff --namespace="App\Migrations")

symfony.migration.execute: ## Excecute migration file
	$(call symfony.console, doctrine:migrations:execute ${ARGS})

.DEFAULT_GOAL := help
SHELL=/bin/bash
APP_DIR=apps/sylius
DOMAINS=${APP_DIR}:nocommerce
SYLIUS_FIXTURES_SUITE=nocommerce
SYMFONY=cd ${APP_DIR} && symfony
COMPOSER=${SYMFONY} composer
CONSOLE=${SYMFONY} console
PHPSTAN=${SYMFONY} php vendor/bin/phpstan
PHPUNIT=${SYMFONY} php vendor/bin/phpunit
PHPSPEC=${SYMFONY} php vendor/bin/phpspec
BASH_CONTAINER=php
DOCKER_COMPOSE=docker-compose

export USER_UID=$(shell id -u)

ifdef FORTRESS_HOST
DC_DIR=infra/fortress
APP_ENV=fortress
SYMFONY_USE_DOCKER_ONLY=1


else
DC_DIR=infra/dev
DC_PREFIX=nocommerce
APP_ENV=dev

endif

ifndef DC_PREFIX
  $(error Please define DC_PREFIX before running make)
endif

include resources/makefiles/development.mk
include resources/makefiles/sylius.mk
include resources/makefiles/symfony.mk
include resources/makefiles/platform.mk
include resources/makefiles/testing.mk
include resources/makefiles/help.mk

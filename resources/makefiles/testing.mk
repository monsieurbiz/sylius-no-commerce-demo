###
### TESTS
### ¯¯¯¯¯

test.all: test.composer test.phpstan test.phpunit test.phpspec test.phpcs test.yaml test.schema test.twig ## Run all tests in once

test.composer: ## Validate composer.json
	$(call symfony.composer,validate --strict)

test.phpstan: ## Run PHPStan
	${PHPSTAN} analyse -c phpstan.neon src/

test.phpunit: ## Run PHPUnit
	${PHPUNIT}

test.phpspec: ## Run PHPSpec
	${PHPSPEC} run

test.phpcs: ## Run PHP CS Fixer in dry-run
	$(call symfony.composer,run -- phpcs --dry-run -v)

test.phpcs.fix: ## Run PHP CS Fixer and fix issues if possible
	$(call symfony.composer,run -- phpcs -v)

test.phpmd: ## Run PHP Mass Detector
	$(call symfony.composer,run -- phpmd)

test.container: ## Lint the symfony container
	$(call symfony.console,lint:container)

test.yaml: ## Lint the symfony Yaml files
	$(call symfony.console,lint:yaml src/Resources/config config)

test.schema: ## Validate MySQL Schema
	$(call symfony.console,doctrine:schema:validate)

test.twig: ## Validate Twig templates
	${CONSOLE} lint:twig -e prod --no-debug templates/ src/Resources/views/

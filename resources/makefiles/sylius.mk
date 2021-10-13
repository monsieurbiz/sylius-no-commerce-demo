###
### SYLIUS
### ¯¯¯¯¯¯

sylius: dependencies sylius.database sylius.fixtures sylius.theming.build sylius.assets ## Install Sylius
.PHONY: sylius

sylius.database: ## Setup the database
	$(call symfony.console,doctrine:database:drop --if-exists --force)
	$(call symfony.console,doctrine:database:create --if-not-exists)
	$(call symfony.console,doctrine:migr:migr -n)

sylius.fixtures: ## Run the fixtures
	$(call symfony.console,sylius:fixtures:load -n ${SYLIUS_FIXTURES_SUITE})

sylius.assets: ## Install all assets with symlinks
	$(call symfony.console,assets:install --symlink)
	$(call symfony.console,sylius:install:assets)
	$(call symfony.console,sylius:theme:assets:install --symlink)

.PHONY: sylius.theming.build
sylius.theming.build: yarn.install ## Build the themes
	$(call yarn,encore prod)

.PHONY: sylius.theming.watch
sylius.theming.watch: yarn.install ## Build the themes
	$(call yarn,encore dev --watch)

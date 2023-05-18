include .env
export


BUILDKIT_PROGRESS := plain # Options: tty | plain | auto

laravel := docker-compose exec app
lint_path := app database routes

UID := $(-shell uid -u)
GID := $(-shell uid -g)

up:
	@docker-compose up -d
	@open http://localhost:8000 # The web page.


down:
	@docker-compose down


build:
	@docker-compose build app


ls:
	@docker-compose exec app ls -l


# NOTE: This will complain that the directory is not empty.
# So, set the path to something like /var/www/app, then copy the contents to
# the root directory.
setup:
	@$(laravel) composer create-project laravel/laravel /var/www/


install:
	@$(laravel) rm -rf vendor composer.lock
	@$(laravel) composer install


composer:
	@$(laravel) composer require --dev phpstan/phpstan
	@$(laravel) composer require --dev friendsofphp/php-cs-fixer


migrate:
	@#$(laravel) env DB_HOST=db php artisan migrate:install
	@$(laravel) env DB_HOST=db php artisan migrate


migrate-new: validate-name
	@$(laravel) env DB_HOST=db php artisan make:model -f -m $(name)


.PHONY: artisan
artisan:
	@$(laravel) php artisan $(name)


test: # run unit test
	@$(laravel) php artisan test


lint: # Run phpstan https://phpstan.org/user-guide/getting-started
	@for f in $(lint_path); do $(laravel) vendor/bin/php-cs-fixer fix $$f; done
	@$(laravel) vendor/bin/phpstan analyse $(lint_path)



seed:
	@$(laravel) env DB_HOST=db php artisan db:seed


artisan-cli:
	@docker-compose exec app bash


psql:
	@docker-compose exec db psql -h $(DB_HOST) -U $(DB_USERNAME) -d $(DB_DATABASE)

#validate-name:
#ifndef name
    #$(error 'name=<name> is required')
#endif

# Other useful commands:
# php artisan about - show configuration
#
#
# API
#
# php artisan make:resource UserResource - creates a resource
# php artisan make:resource UserCollection - creates a collection
# php artisan make:request UserRequest - creates a request object for validation
# php artisan make:controller UserController --api --resource
#
# Models
#
# php artisan make:model User --all - create models
# php artisan model:show User - show details about a model

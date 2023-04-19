include .env
export


BUILDKIT_PROGRESS := plain # Options: tty | plain | auto

laravel := docker-compose exec app
lint_path := app database routes


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

migrate-new:
ifndef name
    $(error, 'make migrate-new name=<name>, name is required')
else
	@$(laravel) env DB_HOST=db php artisan make:model -f -m $(name)
endif


.PHONY: artisan
artisan:
	@$(laravel) php artisan $(name)


test: # run unit test
	@$(laravel) php artisan test


lint: # Run phpstan https://phpstan.org/user-guide/getting-started
	@for f in $(lint_path); do $(laravel) vendor/bin/php-cs-fixer fix $$f; done
	@$(laravel) vendor/bin/phpstan analyse $(lint_path)


seed-new:
ifndef name
    $(error, 'name required, run "seed-new <name, e.g. UsersTableSeeder>"')
else
	@$(laravel) php artisan make:seeder $(name)
endif


seed:
	@$(laravel) env DB_HOST=db php artisan db:seed

# Other useful commands:
# php artisan about - show configuration

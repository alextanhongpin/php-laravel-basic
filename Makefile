include .env
export


BUILDKIT_PROGRESS := tty
BUILDKIT_PROGRESS := plain

laravel := docker-compose exec app


up:
	@docker-compose up -d


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


migrate:
	@$(laravel) env DB_HOST=db php artisan migrate:install
	@$(laravel) env DB_HOST=db php artisan migrate


.PHONY: artisan
artisan:
	@$(laravel) php artisan $(name)

# php artisan about - show configuration

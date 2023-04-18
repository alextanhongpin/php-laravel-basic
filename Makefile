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


setup:
	@$(laravel) composer create-project laravel/laravel /var/www/myapp

dev: dev-run dependencies migration

dev-run:
	docker-compose -f docker-compose.yaml -f docker-compose.dev.yaml up -d --build

actual: dependencies migration

dependencies:
	docker-compose exec app composer install --no-interaction

migration:
	docker-compose exec app bin/console doctrine:migrations:migrate --no-interaction
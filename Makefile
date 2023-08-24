CONTAINER_PHP=php

run-app-with-setup:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec ${CONTAINER_PHP} /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate"

run-app-with-setup-db:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec ${CONTAINER_PHP} /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan migrate:fresh --seed"

run-migrate:
	docker exec ${CONTAINER_PHP} /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan migrate:fresh"
run-app:
	docker compose up -d

kill-app:
	docker compose down

enter-nginx-container:
	docker exec -it nginx /bin/sh

enter-php-container:
	docker exec -it ${CONTAINER_PHP} /bin/sh

enter-mysql-container:
	docker exec -it mysql /bin/sh

flush-db:
	docker exec ${CONTAINER_PHP} /bin/sh -c "php artisan migrate:fresh"

flush-db-with-seeding:
	docker exec ${CONTAINER_PHP} /bin/sh -c "php artisan migrate:fresh --seed"
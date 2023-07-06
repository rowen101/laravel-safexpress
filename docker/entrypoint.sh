#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi
role=${CONTAINER_ROLE:-app}

#if [ "$role" = "app"]; then
    php artisan migrate
    php artisan optimize clear
    php artisan view:clear
    php artisan route:clear
    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env

# elsif [ "$role" = "queue" ]; then
#     echo "Running the queue... "
#     php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
# elseif [ "$role" = "websocket" ]; then
#     echo "Running the queue..."
#fi
# php-fpm -D
nginx -g "daemon off;"
exec docker-php-entrypoint "$@"

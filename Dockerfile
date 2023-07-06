# Used for prod build.
FROM php:8.1

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev curl git zip
RUN docker-php-ext-install pdo pdo_mysql mbstring

RUN curl -sS https://getcomposer.org/install | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY composer.json .
RUN composer install -no=scripts
COPY . .


CMD php artisan serve -host=0.0.0.0 --port=80
# RUN pecl install -o -f redis \
#     && rm -rf /tmp/pear \
#     && docker-php-ext-enable redis

# WORKDIR /var/www
# COPY . .

# COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# ENV PORT=8000
# ENTRYPOINT [ "docker/entrypoint.sh" ]

#==============================================#

# node
# FROM node:14-alpine as node

# WORKDIR /var/www
# COPY . .

# RUN npm install --global cross-ENV
# RUN npm install

# VOLUME /var/www/node_modules

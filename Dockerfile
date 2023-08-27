FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    nginx \
    && docker-php-ext-install pdo pdo_mysql libjpeg-dev

# Copy composer executable.
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

# Copy files from current folder to container current folder (set in workdir).
COPY --chown=www-data:www-data . .

# Create laravel caching folders.
RUN mkdir -p /var/www/storage/framework /var/www/storage/framework/cache \
    /var/www/storage/framework/testing /var/www/storage/framework/sessions \
    /var/www/storage/framework/views

RUN mkdir -p /var/www/storage /var/www/storage/logs /var/www/storage/framework \
    /var/www/storage/framework/sessions /var/www/bootstrap

# Fix files ownership.
RUN chown -R www-data /var/www/storage
RUN chown -R www-data /var/www/storage/framework
RUN chown -R www-data /var/www/storage/framework/sessions

# Set correct permission.
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/storage/logs
RUN chmod -R 755 /var/www/storage/framework
RUN chmod -R 755 /var/www/storage/framework/sessions


COPY . /var/www

CMD ["php-fpm"]


#Run the entrypoint file.
# ENTRYPOINT [ "docker/entrypoint.sh" ]


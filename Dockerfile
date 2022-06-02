#FROM composer:2.0 as build
#COPY . /src/
#RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM php:8.0-apache-buster as production

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

#ENV APP_ENV=production
#ENV APP_DEBUG=false

#RUN php artisan config:cache && \
#    php artisan route:cache && \
#    chmod 777 -R /var/www/html/storage/ && \
#    chown -R www-data:www-data /var/www/
#    a2enmod rewrite

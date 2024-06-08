# syntax=docker/dockerfile:1

FROM php:8.3-fpm

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y unzip git \
    && docker-php-ext-install gettext \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

COPY . /var/www/html

RUN usermod  -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && chown -R www-data:www-data /var/www/

USER www-data

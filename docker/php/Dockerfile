FROM php:8.1-fpm

RUN pecl install redis
RUN docker-php-ext-enable redis

WORKDIR /usr/src/app

RUN chown -R www-data:www-data .
RUN chmod -R o+w .
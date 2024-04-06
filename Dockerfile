FROM php:8.1.2-apache

COPY . /var/www/html/

RUN docker-php-ext-install mysqli pdo_mysql
RUN docker-php-ext-enable mysqli pdo_mysql
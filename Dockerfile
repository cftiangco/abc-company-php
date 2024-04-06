FROM php:8.1.2-apache

#COPY . /var/www/html/
#RUN apt-get update && apt-get install -y net-tools iputils-ping telnet

RUN docker-php-ext-install mysqli pdo_mysql
RUN docker-php-ext-enable mysqli pdo_mysql
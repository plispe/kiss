FROM php:7.1-apache

RUN apt-get update && \
    apt-get install -y libicu-dev libxml2-dev php5-dev php-pear git && \
    a2enmod rewrite && \
    docker-php-ext-install gettext mysqli xmlrpc intl bcmath opcache zip pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer global require "hirak/prestissimo:^0.3"


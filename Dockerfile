FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT /app/www

COPY . /app
WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt update
RUN apt install -y \
    git \
    zip

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

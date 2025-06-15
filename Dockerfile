FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl pgsql

# COPY php.ini /usr/local/etc/php/
RUN a2enmod rewrite

# Ganti DocumentRoot ke public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/public

# composer create-project codeigniter4/appstarter ci4
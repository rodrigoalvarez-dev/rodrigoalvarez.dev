FROM php:8.5-apache

ARG WWWUSER=1000
ARG WWWGROUP=1000

RUN groupadd --force --gid ${WWWGROUP} sail \
    && useradd --uid ${WWWUSER} --gid ${WWWGROUP} --create-home --shell /bin/bash sail

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    libonig-dev \
 && docker-php-ext-install pdo pgsql pdo_pgsql zip fileinfo mbstring intl \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && a2enmod rewrite headers \
 && sed -ri -e 's#DocumentRoot .*#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
 && printf '\n<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/sites-available/000-default.conf \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

FROM php:8.2-fpm-buster

WORKDIR /var/www/project/api

RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc \

RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
  && docker-php-ext-install pdo_mysql gd pdo sockets bcmath xsl xml soap pcntl \
  && docker-php-ext-enable gd

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install \
    pdo pdo_mysql zip xsl gd intl opcache exif mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer






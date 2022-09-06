FROM php:8.1.9-fpm-alpine AS build_php
WORKDIR /app

ARG APP_ENV
ENV APP_ENV $APP_ENV

RUN apk upgrade --update \
    && apk add --no-cache \
        # For postgres
        postgresql-dev \
        # Composer
        git \
        zip \
        # For Intl extension
        icu-data-full \
        # For mbregex
        oniguruma-dev \
        nodejs \
        yarn \
&& docker-php-ext-configure opcache --enable-opcache \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure mbstring --enable-mbstring \
&& docker-php-ext-install -j$(nproc) opcache intl pgsql pdo_pgsql mbstring

COPY --chown=www-data:www-data config/docker/php/custom.ini $PHP_INI_DIR/conf.d/custom.ini

# Build code
COPY --from=composer:2.4.0 /usr/bin/composer /usr/local/bin/composer

EXPOSE 9000


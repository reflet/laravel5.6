# -----------------------------------------------------
# PHP Dependencies
FROM composer:1.8 as vendor
COPY ./src/ /app/
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# -----------------------------------------------------
# Frontend
FROM node:11.11 as frontend
RUN mkdir -p /app/public
COPY src/package.json src/webpack.mix.js /app/
COPY src/resources/assets/ /app/resources/assets/
WORKDIR /app
RUN yarn install && yarn production

# -----------------------------------------------------
# Application
FROM php:7.2-fpm

ARG USER="www-data"
ARG UID="1000"
ARG GROUP="www-data"
ARG GID="1000"

# timezone (Asia/Tokyo)
ENV TZ JST-9
ENV TERM xterm

# tools
RUN apt-get -y update && apt-get install -y vim less zip unzip

# php options (mysql)
RUN docker-php-ext-install mysqli pdo_mysql

# php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# application directory
ARG APP_DIR="/var/www/www.example.com"
RUN mkdir -p $APP_DIR
WORKDIR $APP_DIR

# user setting
RUN usermod -u $UID $USER && groupmod -g $GID $GROUP
RUN chown -R $UID:$GID $APP_DIR

# copy codes.
COPY --chown=www-data:www-data ./src ./
COPY --chown=www-data:www-data --from=vendor /app/vendor/ ./vendor/
COPY --chown=www-data:www-data --from=frontend /app/node_modules/ ./node_modules/
COPY --chown=www-data:www-data --from=frontend /app/public/js/ ./public/js/
COPY --chown=www-data:www-data --from=frontend /app/public/css/ ./public/css/
COPY --chown=www-data:www-data --from=frontend /app/mix-manifest.json ./mix-manifest.json

# set environment file.
RUN cp .env.example .env && php artisan key:generate

USER $USER

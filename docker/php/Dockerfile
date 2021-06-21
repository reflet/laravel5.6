FROM php:7.3-fpm

ARG USER="www-data"
ARG UID="1000"
ARG GROUP="www-data"
ARG GID="1000"

# timezone (Asia/Tokyo)
ENV TZ JST-9
ENV TERM xterm

# tools
RUN apt-get -y update \
    && apt-get install -y vim less zip unzip \
       libpq-dev \
       libfreetype6-dev \
       libjpeg62-turbo-dev \
       libpng-dev \
       libzip-dev

# php options (zip)
RUN docker-php-ext-install zip

# php options (gd)
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd exif

# php options (mysql)
RUN docker-php-ext-install mysqli pdo_mysql

# php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# application directory
ARG APP_DIR="/var/www/www.example.com"
RUN mkdir -p $APP_DIR

# user setting
RUN usermod -u $UID $USER && groupmod -g $GID $GROUP
RUN chown -R $UID:$GID $APP_DIR

# copy composer command.
COPY --chown=www-data:www-data --from=composer:1.9 /usr/bin/composer /usr/bin/composer
RUN composer config -g repos.packagist composer https://packagist.jp

# copy codes.
WORKDIR $APP_DIR
COPY --chown=www-data:www-data ./src ./

# change user ( root -> www-data )
USER $USER

# composer install
RUN composer install \
    -d $APP_DIR \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# set environment file.
RUN cp .env.example .env && php artisan key:generate
RUN sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env

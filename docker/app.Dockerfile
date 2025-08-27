FROM composer:2 AS composer_stage
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist

FROM php:8.2-fpm
WORKDIR /var/www/html
COPY --from=composer_stage /app/vendor ./vendor

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev libzip-dev libpq-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev \
    locales \
    zip unzip tar gzip\
    jpegoptim optipng pngquant gifsicle \
    vim tree git curl \
    autoconf pkg-config re2c \
 && docker-php-source extract \
 && git clone --branch 6.0.2 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
 && docker-php-ext-install redis \
 && docker-php-source delete \
 && docker-php-ext-install pdo_pgsql mbstring zip exif pcntl \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www/html

COPY --chown=www:www . /var/www/html

USER www

EXPOSE 9000
CMD ["php-fpm"]

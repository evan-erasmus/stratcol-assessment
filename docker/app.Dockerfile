FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl
RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www/html

COPY --chown=www:www . /var/www/html

USER www

EXPOSE 9000
CMD ["php-fpm"]

FROM php:7.4-fpm-alpine

WORKDIR /var/www
RUN apk update
RUN apk upgrade
RUN apk add composer
RUN apk update \
  && apk upgrade \
  && apk add --no-cache \
  freetype-dev \
  libpng-dev \
  jpeg-dev \
  libjpeg-turbo-dev \
  libpng \
  libwebp-dev \
  libxpm-dev gd \
  libzip-dev
RUN apk add --no-cache zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN NUMPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
  && docker-php-ext-install -j${NUMPROC} gd

RUN docker-php-ext-install pdo pdo_mysql
RUN chown -R www-data:www-data /var/www
RUN mkdir /var/www/storage
RUN chmod -R 777 /var/www/storage


FROM php:8.2.0-fpm-alpine

RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash
RUN apk add --update linux-headers

ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; \
    then \
      pecl channel-update pecl.php.net && pecl install xdebug && docker-php-ext-enable xdebug; \
    fi;



COPY ./docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data



COPY ./ /var/www
WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD php-fpm

EXPOSE 9000

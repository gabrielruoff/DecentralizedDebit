FROM php:7.4-fpm

RUN mkdir -p /usr/local/crontabs/logs

RUN apt-get -qq -y update && apt-get -qq -y install \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get -qq -y install imagemagick \
    && apt-get -qq -y install exiftool \
    && apt-get -qq -y install libmcrypt-dev \
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt \
    && pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug \
    && apt-get -qq -y install libgpgme11-dev libcurl4-openssl-dev \
    && apt-get -qq -y install gnupg git \
    && pecl install gnupg \
    && docker-php-ext-enable gnupg \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install curl \
    && mkdir -p /var/www/ \
    && rm /usr/local/etc/php-fpm.d/www.conf \
    && adduser nginx \
    && mkdir -p /home/nginx/.gnupg \
    && chown -R nginx:nginx /var/www/
    RUN apt-get -qq -y install cron \
    supervisor \
    && apt-get -qq -y install rsyslog \
    && chown -R nginx:nginx /usr/local/crontabs/

RUN mkdir -p /usr/local/xmr_payment_listener/logs \
    && chown -R nginx:nginx /usr/local/xmr_payment_listener

# copy over crontabs
COPY crontabs /usr/local/crontabs/

# copy over php configuration files
COPY www.conf /usr/local/etc/php-fpm.d/
COPY php.ini /usr/local/etc/php

# copy over supervisor conf file
COPY supervisord.conf /etc/supervisor/supervisord.conf

# switch to nginx to install crontabs for php user
USER nginx
RUN crontab /usr/local/crontabs/crontabs
USER root

# set permsissions for gnupg
RUN chown -R nginx:nginx /home/nginx/.gnupg \
    && chmod 700 /home/nginx/.gnupg

# start supervisor
CMD ["/usr/bin/supervisord"]

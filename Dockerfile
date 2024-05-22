FROM php:8.1-apache

WORKDIR /BEM-server
COPY . .
# PHP extensions
RUN docker-php-ext-configure pdo_pgsql \
    && docker-php-ext-configure pgsql \
    && docker-php-ext-install grpc \
    && docker-php-ext-install exif \
    && docker-php-ext-install gettext \
    && docker-php-ext-install gd \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install zip
# ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
# RUN install-php-extensions bz2 gd gettext exif pdo_pgsql grpc pgsql

#Composer
# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install
RUN composer dump-autoload






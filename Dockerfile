FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

# Установка системных библиотек для расширений
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Настройка и установка PHP-расширений (pdo, pdo_pgsql, gd, intl, zip)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    gd \
    intl \
    zip

# Установка расширения redis через PECL
RUN pecl install redis && docker-php-ext-enable redis

# Копируем Composer из официального образа
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g ${GID} laravel \
    && useradd -u ${UID} -g ${GID} -m -s /bin/bash laravel

WORKDIR /var/www

USER laravel

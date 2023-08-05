# 使用官方 PHP 8.1 映像
FROM php:8.1-fpm

# 安裝必要的套件和擴展
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    zip \
    ffmpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

RUN pecl install mongodb && docker-php-ext-enable mongodb

# 設定工作目錄
WORKDIR /var/www/html

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 設定權限
RUN chown -R www-data:www-data /var/www/html

CMD php artisan serve --host=0.0.0.0 --port=8000

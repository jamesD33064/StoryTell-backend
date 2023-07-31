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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

RUN pecl install mongodb && docker-php-ext-enable mongodb

# 設定工作目錄
WORKDIR /var/www/html

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 複製 Laravel 專案到工作目錄
COPY . /var/www/html

# 安裝 Laravel 相依套件
RUN composer install --optimize-autoloader --no-dev

# 設定權限
RUN chown -R www-data:www-data /var/www/html

# 設定容器執行的命令
CMD php artisan serve --host=0.0.0.0 --port=8000
# 會用其他的網頁伺服器


# cicd for production才會composer install 把環境建好＆複製整個專案

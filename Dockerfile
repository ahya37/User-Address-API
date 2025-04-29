FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    gnupg \
    libpng-dev \ 
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Aktifkan mod_rewrite di Apache
RUN a2enmod rewrite

# Set workdir ke dalam Laravel
WORKDIR /var/www/html

# Copy file Laravel kecuali yang ada di .dockerignore
COPY . .

# Berikan izin ke storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 8083

# Jalankan perintah untuk Laravel
CMD ["sh", "-c", "composer install --no-interaction --prefer-dist --optimize-autoloader && php artisan serve --host=0.0.0.0 --port=8083"]

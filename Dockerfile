FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libicu-dev && \
    docker-php-ext-install zip intl mbstring opcache pdo_mysql

# Configura PHP para producción
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    echo "memory_limit = 512M" >> "$PHP_INI_DIR/conf.d/custom.ini"

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copia los archivos
COPY . /var/www/html
WORKDIR /var/www/html

# Instala dependencias
RUN composer install --no-dev --optimize-autoloader

# Configura Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    a2enmod rewrite && \
    chown -R www-data:www-data /var/www/html/writable

EXPOSE 80
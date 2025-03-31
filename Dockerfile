FROM php:8.2-apache

# 1. Instala dependencias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libicu-dev \  # Necesario para ext-intl
    && docker-php-ext-install \
    zip \
    intl \       # Extensión requerida
    mbstring \   # Otra extensión requerida
    opcache \
    pdo_mysql

# 2. Configuración recomendada para producción
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    echo "memory_limit = 512M" >> "$PHP_INI_DIR/conf.d/custom.ini"

# 3. Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 4. Copia los archivos del proyecto
COPY . /var/www/html
WORKDIR /var/www/html

# 5. Instala dependencias (sin desarrollo)
RUN composer install --no-dev --optimize-autoloader

# 6. Configura Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    a2enmod rewrite && \
    chown -R www-data:www-data /var/www/html/writable

EXPOSE 80
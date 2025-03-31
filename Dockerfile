FROM php:8.2-apache

# Instala dependencias del sistema y PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto
COPY . /var/www/html
WORKDIR /var/www/html

# Instala dependencias de Composer (sin dev)
RUN composer install --no-dev --optimize-autoloader

# Configura Apache para usar la carpeta public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Puerto expuesto (necesario para Render)
EXPOSE 10000

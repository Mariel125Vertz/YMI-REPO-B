FROM php:8.2-cli

# Instalamos dependencias del sistema necesarias para extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql zip

# Instalamos Composer de forma oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos todo tu código
COPY . /var/www/html
WORKDIR /var/www/html

# EJECUTAMOS COMPOSER para que cree la carpeta 'vendor'
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080

# Usamos la ruta absoluta que ya confirmamos que funciona
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public", "/var/www/html/public/index.php"]
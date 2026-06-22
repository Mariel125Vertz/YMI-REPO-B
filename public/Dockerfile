# Imagen de PHP con Apache
FROM php:8.3-apache

# Extensiones necesarias para MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos todo el proyecto
COPY . .

# El composer.json vive dentro de public/, así que instalamos ahí
WORKDIR /var/www/html/public
RUN composer install --no-dev --optimize-autoloader

# Apache debe servir desde /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

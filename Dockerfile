# Usamos una imagen de PHP con Apache
FROM php:8.3-apache

# Instalamos las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalamos Composer para manejar tus dependencias
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos el directorio de trabajo
WORKDIR /var/www/html

# Copiamos los archivos de tu proyecto
COPY . .

# Instalamos dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Ajustamos permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Configuramos el DocumentRoot de Apache para que apunte a 'public'
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
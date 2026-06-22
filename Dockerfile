# Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# Instalamos extensiones necesarias (p.ej. mysqli para tu base de datos)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiamos todo el contenido de tu repo a la carpeta raíz de Apache
COPY . /var/www/html/

# IMPORTANTE: Configuramos Apache para que use 'public' como raíz
# Esto sobreescribe la configuración por defecto de Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Damos permisos correctos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
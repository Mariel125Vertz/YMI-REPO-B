FROM php:8.2-apache

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. SOLUCIÓN AL ERROR MPM: Deshabilitamos el módulo conflictivo y habilitamos prefork
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# Copiamos todo el contenido
COPY . /var/www/html/

# Configuramos Apache para que use 'public'
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
FROM php:8.2-apache

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. Limpieza radical de módulos MPM conflictivos
# Deshabilitamos TODOS los posibles MPMs que vienen por defecto
RUN a2dismod mpm_event mpm_worker mpm_prefork || true

# 2. Habilitamos ÚNICAMENTE prefork (necesario para PHP)
RUN a2enmod mpm_prefork

# Copiamos tu código
COPY . /var/www/html/

# Configuramos Apache para que use 'public' como raíz
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
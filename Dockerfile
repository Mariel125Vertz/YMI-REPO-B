FROM php:8.2-apache

# Instalamos extensiones
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. Borramos cualquier configuración de MPM existente para evitar el conflicto
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load

# 2. Habilitamos ÚNICAMENTE prefork (el estándar para PHP)
RUN a2enmod mpm_prefork

# 3. Copiamos los archivos
COPY . /var/www/html/

# 4. Ajustamos Apache para que use /public como raíz
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 5. Damos permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
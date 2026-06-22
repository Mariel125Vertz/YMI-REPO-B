FROM php:8.2-apache

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. ELIMINAMOS cualquier configuración previa de MPM
# Esto es lo que causaba el conflicto
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load

# 2. Habilitamos ÚNICAMENTE mpm_prefork (necesario para PHP)
RUN a2enmod mpm_prefork

# 3. Copiamos tus archivos
COPY . /var/www/html/

# 4. Ajustamos la raíz para que apunte a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 5. Damos permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
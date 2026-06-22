FROM php:8.2-apache

# Instalamos las extensiones necesarias para tu base de datos
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. ELIMINACIÓN RADICAL: Borramos cualquier rastro de otros módulos MPM
# antes de que Apache tenga oportunidad de cargarlos
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && rm -f /etc/apache2/mods-enabled/mpm_*.conf

# 2. Habilitamos ÚNICAMENTE mpm_prefork (necesario para PHP)
RUN a2enmod mpm_prefork

# 3. Copiamos los archivos de tu proyecto
COPY . /var/www/html/

# 4. Ajustamos la configuración de Apache para que el DocumentRoot sea /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 5. Ajustamos permisos para que el servidor pueda leer tus archivos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

# 6. Forzamos el arranque en primer plano sin configuraciones extra
CMD ["apache2-foreground"]
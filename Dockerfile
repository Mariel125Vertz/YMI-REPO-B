FROM php:8.2-apache

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 1. Deshabilitamos los MPM que vienen por defecto en la imagen base
# Usamos '|| true' para que no falle si alguno ya estaba deshabilitado
RUN a2dismod mpm_event mpm_worker || true

# 2. Habilitamos ÚNICAMENTE mpm_prefork
RUN a2enmod mpm_prefork

# 3. Copiamos tus archivos
COPY . /var/www/html/

# 4. Ajustamos la raíz para que apunte a /public
# (Asegúrate de que la ruta sea correcta según tu estructura de archivos)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Opcional: Aseguramos permisos correctos
RUN chown -R www-data:www-data /var/www/html
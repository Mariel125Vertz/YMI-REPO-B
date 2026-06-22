FROM php:8.2-apache

# Instalamos extensiones
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalamos herramientas para debug (opcional, ayuda a ver qué pasa)
RUN apt-get update && apt-get install -y iputils-ping

# 1. Limpieza de módulos (esto es vital para evitar el error de MPM)
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# 2. Copiamos todo el contenido del repositorio al directorio de trabajo de Apache
# Usamos el punto para indicar que todo lo de tu repo va a /var/www/html/
COPY . /var/www/html/

# 3. Ajustamos la configuración de Apache para apuntar a la subcarpeta 'public'
# Esto cambia el DocumentRoot globalmente
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 4. Asignamos permisos correctos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
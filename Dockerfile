# Usa una imagen de PHP con Apache
FROM php:8.2-apache

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia todo el contenido de la raíz a la carpeta del servidor
COPY . .

# IMPORTANTE: Configura Apache para que apunte a la carpeta 'public'
# Esto le dice a Apache que el "Document Root" es la carpeta /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Exponer el puerto
EXPOSE 80
# Usamos una imagen de PHP básica
FROM php:8.2-cli

# Instalamos extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiamos todo tu código al contenedor
COPY . /var/www/html

# Nos movemos a la carpeta de tu aplicación
WORKDIR /var/www/html

# Exponemos el puerto 8080 (que es el que Railway suele usar)
EXPOSE 8080

# ARRANCAMOS EL SERVIDOR NATIVO DE PHP
# Esto hace que PHP sirva los archivos directamente desde la carpeta 'public'
# Cambia tu CMD por esta línea:
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public", "/var/www/html/public/index.php"]